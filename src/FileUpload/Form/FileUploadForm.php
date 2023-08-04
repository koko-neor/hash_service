<?php

namespace app\src\FileUpload\Form;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Class FileUploadForm
 */
class FileUploadForm extends Model
{
    public ?string $name = null;
    public ?string $description = null;
    public ?UploadedFile $file = null;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'name'        => 'Название',
            'description' => 'Описание',
            'file'        => 'Файл',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'description', 'file'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
            ['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'txt,docx'],
        ];
    }
}