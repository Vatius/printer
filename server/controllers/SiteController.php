<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;

class SiteController extends Controller
{

    /**
     * Hello (test)
     */
    public function actionIndex()
    {
        return ['data' => 'hello, api', 'error' => null];
    }

    //some here...

}
