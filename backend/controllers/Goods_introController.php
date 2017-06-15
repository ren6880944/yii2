<?php

namespace backend\controllers;

use backend\models\Goods_Intro;

class Goods_introController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model=Goods_Intro::find()->all();
        return $this->render('index',['model'=>$model]);
    }
    public function actionAdd(){
        $model=new Goods_Intro();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            var_dump(\Yii::$app->request->post());exit;
            $model->save();
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['goods_intro/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    //修改
    public function actionEdit($id){
        $model=Goods_Intro::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
//            var_dump(\Yii::$app->request->post());exit;
            $model->save();
            \Yii::$app->session->setFlash('warning','修改成功');
            return $this->redirect(['goods_intro/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}" ,//上传保存路径
                    "imageRoot" => \Yii::getAlias("@webroot"),
            ],
        ]
    ];
    }
    public function actionLook($id){
        $model=Goods_Intro::findOne($id);
        return $this->render('look',['model'=>$model]);
    }
}
