<?php

namespace app\controllers;

use app\src\FileUpload\Dto\FileUploadDto;
use app\src\FileUpload\FileUploadService;
use app\src\FileUpload\Form\FileUploadForm;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class FileController extends Controller
{
    public $enableCsrfValidation = false;

    private FileUploadService $service;

    public function __construct($id, $module, FileUploadService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'upload' => ['POST'],
                ],
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionUpload(): Response
    {
        try {
            $request = new FileUploadForm();
            $request->file = UploadedFile::getInstance($request, 'file');
            $request->load(Yii::$app->request->post());

            if (!$request->validate()) {
                $errors = [];
                $errorMessages = [];
                foreach ($request->getErrors() as $attribute => $errorMessagesArray) {
                    $errors[$attribute] = $errorMessagesArray[0]; // Берем только первое сообщение об ошибке
                    $errorMessages[] = $errorMessagesArray[0];
                }
                Yii::error('Ошибка при загрузке файла: ' . json_encode($errors));
                return $this->asJson([
                    'message' => implode('; ', $errorMessages),
                    'model' => null,
                    'status' => 422
                ]);
            }


            $result = $this->service->handleCreateOrFindHashFile(
                FileUploadDto::fromRequest($request)
            );

            return $this->asJson([
                'message' => $result->getMessage(),
                'model' => $result->getModel(),
                'status' => 200
            ]);

        } catch (\Exception $exception) {
            Yii::error('Ошибка при загрузке файла: ' . $exception->getMessage());
            return $this->asJson([
                'message' => 'Ошибка при загрузке файла:',
                'model' => null,
                'status' => 500
            ]);
        }
    }
}