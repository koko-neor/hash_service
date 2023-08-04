<?php

namespace app\src\FileUpload\Repository;

use app\models\File;
use app\src\FileUpload\Dto\FileUploadDto;
use yii\db\ActiveRecord;
use Exception;

class FileRepository
{
    /**
     * @param string $hash
     * @return ActiveRecord|array|null
     */
    public function findByHash(string $hash): ?File
    {
        return File::find()->where(['hash' => $hash])->one();
    }

    /**
     * @throws Exception|\Throwable
     */
    public function add(FileUploadDto $dto): void
    {
        \Yii::$app->db->transaction(function () use ($dto) {
            \Yii::$app->db->createCommand()->insert('{{file}}', [
                'hash' => $dto->getHash(),
                'name' => $dto->getName(),
                'description' => $dto->getDescription(),
                'file' => $dto->getHash() . '.' . $dto->getFile()->extension,
                'created_at' => $dto->getCreatedAt()
            ])->execute();
        });
    }
}