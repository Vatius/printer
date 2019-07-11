<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Order;
use app\models\Printer;
use app\models\Cartridge;
use app\models\Cart;

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
            $model->tel = $res;
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
            $parts = [];
            if($model->sum >= $printer['price']) {
                $priceWitoutPrinter = $model->sum - $printer['price'];
                if($priceWitoutPrinter == 0) {
                    //have printer(s) only
                    $parts[] = $printer['article'];
                } else {
                    //printer and cartrige
                    $parts[] = $printer['article'];
                    //find cartrigies
                    $cartrigies = Cartridge::find()->where(['printer'=>$printer['id']])->orderBy('price')->asArray()->all();
                    $minCn = 0;
                    $maxCn = count($cartrigies)-1;
                    for($i = 0;$i <= 5;$i++) {
                        if($priceWitoutPrinter > 0) {
                            if ($priceWitoutPrinter - $cartrigies[$maxCn]['price'] >= 0) {
                                $priceWitoutPrinter =  $priceWitoutPrinter - $cartrigies[$maxCn]['price'];
                                $parts[] =  $cartrigies[$maxCn]['article'];
                            } else {
                                $maxCn --;
                            }
                        }
                    }
                }
                $cart = new Cart();
                $cart->order = $id;
                $cart->parts = json_encode($parts);
                $cart->save();

            } else {
                //it is cartrige only
                return ['data' => -1, 'error' => 'it is cartrige only'];
            }
            
            return ['data' => $id, 'error' => null];
        } else {
            return ['data' => -1, 'error' => 'cant create order'];
        }

        

    }

    public function actionList()
    {
        $model = Order::find()->asArray()->all();

        return ['data'=> $model, 'error'=>null];
    }

    public function actionView($id)
    {
        $model = Order::find()->where(['id' => $id])->asArray()->all();

        return ['data'=> $model, 'error'=>null];
    }

    public function actionUpdate()
    {
        //update order for manager
    }

    public function actionSearch()
    {
        //find client..
    }

    public function actionStat()
    {
        //some here...
    }

}
