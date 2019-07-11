<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%printer}}`.
 */
class m190711_140732_create_printer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%printer}}', [
            'id' => $this->primaryKey(),
            'article' => $this->text(),
            'price' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%printer}}');
    }
}
