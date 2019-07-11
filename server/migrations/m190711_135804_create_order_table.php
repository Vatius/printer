<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m190711_135804_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->text()->notNull(),
            'phone' => $this->integer()->notNull(),
            'article' => $this->text()->notNull(),
            'sum' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
