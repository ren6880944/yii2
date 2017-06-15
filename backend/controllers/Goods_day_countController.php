<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\Goods_Day_Count;
use yii\db\Query;

class Goods_day_countController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $query=new Query();
//        $num=$query->from('goods')->count();
//        $date=date('Y-m-d');
//        var_dump($num,$date);exit;
        $model=Goods_Day_Count::find()->all();
        return $this->render('index',['model'=>$model]);
    }

}
