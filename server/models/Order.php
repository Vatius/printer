<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $fio
 * @property int $phone
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
            [['fio', 'phone', 'article', 'sum', 'status'], 'required'],
            [['fio', 'article'], 'string'],
            [['phone', 'sum', 'status'], 'integer'],
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
            'phone' => 'Phone',
            'article' => 'Article',
            'sum' => 'Sum',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
