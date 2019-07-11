<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m190711_154126_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'order' => $this->integer(),
            'parts' => $this->text(),
        ]);

        $this->createIndex(
            'idx-cart-order',
            'cart',
            'order'
        );

        $this->addForeignKey(
            'fk-cart-order',
            'cart',
            'order',
            'order',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart}}');
    }
}
