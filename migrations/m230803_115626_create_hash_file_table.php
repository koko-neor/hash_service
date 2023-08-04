<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hash_file}}`.
 */
class m230803_115626_create_hash_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'hash' => $this->string()->defaultValue(null)->unique(),
            'name' => $this->string()->defaultValue(null),
            'description' => $this->text()->defaultValue(null),
            'file' => $this->string()->defaultValue(null),
            'created_at' => $this->dateTime()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hash_file}}');
    }
}
