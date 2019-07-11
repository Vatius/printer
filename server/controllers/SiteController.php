<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Order;
use app\models\Printer;
use app\models\Cartridge;

class SiteController extends Controller
{

    /**
     * Hello (test)
     */
    public function actionIndex()
    {
        return ['data' => 'hello, api', 'error' => null];
    }

    /**
     * POST (fio,tel,article,sum)
     */
    public function actionOrder()
    {
        $reqData = Yii::$app->request->post();

        $model = new Order();
        //string fio
        if(strlen($reqData['fio']) < 2) {
            return ['data'=>null, 'error'=>'invalid fio'];
        }
        $model->fio = $reqData['fio'];
        //format phone
        if(  preg_match( '/^((8|\+7)[\- ]?)?(\(\9?\d{2}\)?[\- ]?)?([\d\- ]{7,10})$/', $reqData['tel']) ) //не лучшее решение, наверное...
        {
            $res = str_replace('(','',$reqData['tel']);
            $res = str_replace(' ','',$res);
            $res = str_replace(')','',$res);
            $res = str_replace('+','',$res);
            $res = str_replace('-','',$res);
            if($res[0] == '8')
                $res[0] = '7';
            $model->phone = $res;
        } else {
            return ['data'=>null, 'error'=>'invalid phone number'];
        }
        //check printer
        $printer = Printer::find()->where(['article' => $reqData['article']])->asArray()->one();
        if($printer == null) {
            return ['data'=>null, 'error'=>'printer not found'];
        }
        $model->article = $printer['article'];
        //just add sum TODO: validate sum
        $model->sum = $reqData['sum'];

        $model->status = 1;
        $model->created_at = date('Y-m-d H:i:s');

        if($model->save()) {
            $id = Yii::$app->db->getLastInsertID();
            //get order parts
            
            return ['data' => $id, 'error' => null];
        } else {
            return ['data' => $model->validate(), 'error' => null];
        }

        

    }

    public function actionList()
    {
        //list orders for manager
    }

    public function actionUpdate()
    {
        //update order for manager
    }

    public function actionStat()
    {
        //some here...
    }

}
