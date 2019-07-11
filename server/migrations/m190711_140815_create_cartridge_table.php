<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cartridge}}`.
 */
class m190711_140815_create_cartridge_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cartridge}}', [
            'id' => $this->primaryKey(),
            'article' => $this->text(),
            'price' => $this->integer(),
            'printer' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-cartridge-printer',
            'cartridge',
            'printer'
        );

        $this->addForeignKey(
            'fk-cartridge-printer',
            'cartridge',
            'printer',
            'printer',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //TODO: delete index and fk
        $this->dropTable('{{%cartridge}}');
    }
}
