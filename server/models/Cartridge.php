<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cartridge".
 *
 * @property int $id
 * @property string $article
 * @property int $price
 * @property int $printer
 *
 * @property Printer $printer0
 */
class Cartridge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cartridge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article'], 'string'],
            [['price', 'printer'], 'integer'],
            [['printer'], 'exist', 'skipOnError' => true, 'targetClass' => Printer::className(), 'targetAttribute' => ['printer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article' => 'Article',
            'price' => 'Price',
            'printer' => 'Printer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrinter()
    {
        return $this->hasOne(Printer::className(), ['id' => 'printer']);
    }
}
