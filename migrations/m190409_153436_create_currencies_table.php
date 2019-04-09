<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currencies}}`.
 */
class m190409_153436_create_currencies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey(),
            'code' => $this->integer()->comment('Цифр. код'),
            'letter_code' => $this->string(3)->comment('Букв. код'),
            'unit' => $this->float()->comment('Единиц'),
            'name' => $this->string(255)->comment('Валюта'),
            'rate' => $this->float()->comment('Курс'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currencies}}');
    }
}
