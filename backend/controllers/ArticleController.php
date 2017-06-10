<?php

namespace backend\controllers;

use backend\models\Article;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data=Article::find()->where(['!=','status','-1']);
        $pages=new Pagination([
            'totalCount'=>$data->count(),
            'defaultPageSize'=>3,
        ]);
        $model=$data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',['model'=>$model,'pages'=>$pages]);
    }
    public function actionAdd(){
        $model=new Article();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['article/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=Article::findOne(['id'=>$id]);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('warning','修改成功');
                return $this->redirect(['article/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
        $model=Article::findOne(['id'=>$id]);
        if($model==null){
            throw new NotFoundHttpException('删除失败');
        }
        $model->updateAttributes(['status'=>-1]);
        \Yii::$app->session->setFlash('danger','删除成功');
        return $this->redirect(['article/index']);
    }

}
