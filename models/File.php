<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 *  FileUpload model
 *
 * @property integer $id
 * @property integer  $user_id
 * @property float  $balance
 * @property integer $created_at
 * @property integer $updated_at
 *  */
class File extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%file}}';
    }
}
