<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $fio
 * @property string $tel
 * @property string $article
 * @property int $sum
 * @property int $status
 * @property string $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'tel', 'article', 'sum', 'status'], 'required'],
            [['fio', 'article', 'tel'], 'string'],
            [['sum', 'status'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'tel' => 'Phone',
            'article' => 'Article',
            'sum' => 'Sum',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
