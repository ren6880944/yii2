<?php

namespace backend\controllers;

use backend\models\Article_Detail;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class Article_detailController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data=Article_Detail::find();
        $pages=new Pagination([
            'totalCount'=>$data->count(),
            'defaultPageSize'=>4,
        ]);
        $model=$data->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index',['model'=>$model,'pages'=>$pages]);
    }
    public function actionAdd(){
        $model=new Article_Detail();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['article_detail/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($article_id){
        $model=Article_Detail::findOne(['article_id'=>$article_id])->delete();
//        if($model==null){
//            throw new NotFoundHttpException('删除失败');
//        }
//        $model->updateAttributes();
        \Yii::$app->session->setFlash('danger','删除成功');
        return $this->redirect(['article_detail/index']);
    }
    public function actionEdit($article_id){
        $model=Article_Detail::findOne(['article_id'=>$article_id]);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('warning','修改成功');
                return $this->redirect(['article_detail/index']);
            }
        }
        return $this->render('add',['model'=>$model]);
    }

}
