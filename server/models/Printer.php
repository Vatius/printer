<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printer".
 *
 * @property int $id
 * @property string $article
 * @property int $price
 *
 * @property Cartridge[] $cartridges
 */
class Printer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'printer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article'], 'string'],
            [['price'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartridges()
    {
        return $this->hasMany(Cartridge::className(), ['printer' => 'id']);
    }
}
