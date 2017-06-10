<?php

namespace backend\controllers;

use backend\models\Article_Category;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class Article_categoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data=Article_Category::find()->where(['!=','status','-1']);
        $pages=new Pagination(['totalCount'=>$data->count(),'defaultPageSize'=>3]);
        $model=$data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',['model'=>$model,'pages'=>$pages]);
    }
    public function actionAdd(){
        $model=new Article_Category();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['article_category/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=Article_Category::findOne(['id'=>$id]);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('warning','修改成功');
                return $this->redirect(['article_category/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
        $model=Article_Category::findOne(['id'=>$id]);
        if($model==null){
            throw new NotFoundHttpException('类型不存在');
        }
        $model->updateAttributes(['status'=>-1]);
        \Yii::$app->session->setFlash('danger','删除成功');
        return $this->redirect(['article_category/index']);
    }


}
