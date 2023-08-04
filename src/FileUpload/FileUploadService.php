<?php

namespace app\src\FileUpload;


use app\src\FileUpload\Dto\FileUploadDto;
use app\src\FileUpload\Dto\ResultDto;
use app\src\FileUpload\Repository\FileRepository;
use yii\web\UploadedFile;

class FileUploadService
{
    private FileRepository $repository;

    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleCreateOrFindHashFile(FileUploadDto $dto): ResultDto
    {
        try {
            $existingFile = $this->repository->findByHash($dto->getHash());

            if (!$existingFile) {
                $this->repository->add($dto);
                $dto->getFile()->saveAs('@webroot/uploads/' . $dto->getHash() . '.' . $dto->getFile()->extension);

                return new ResultDto('created successfully', null, 200);
            }

            return new ResultDto('File found with this hash', $existingFile, 200);

        } catch (\Throwable $exception) {
            \Yii::error("Error while handling file: " . $exception->getMessage()); // Логирование ошибки
            return new ResultDto('An error occurred while processing the file', null, 500);
        }
    }

}