<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\Goods_Day_Count;
use backend\models\Goods_Img;
use backend\models\Goods_Intro;
use backend\models\GoodsSearchForm;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use yii\web\Response;
use yii\web\UploadedFile;
use xj\uploadify\UploadAction;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $model=Goods::find()->where(['status'=>1])->all();
        $models=new GoodsSearchForm();
        $query=Goods::find();
        $models->search($query);
        $pages=new Pagination([
            'totalCount'=>$query->count(),
            'defaultPageSize'=>5
        ]);
        $model=$query->limit($pages->limit)->offset($pages->offset)->all();
        return $this->render('index',['model'=>$model,'models'=>$models,'pages'=>$pages]);
    }
    public function actionAdd(){
        $model=new Goods();
        $intro=new Goods_Intro();
        $request=new Request();
//        $daycount=new Goods_Day_Count();
        if($request->isPost){
            $model->load($request->post());
//            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
//            var_dump($request->post());exit;
            if($model->validate()){
//                if($model->imgFile){
//                    $filename='/images/'.uniqid().'.'.$model->imgFile->extension;
//                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
//                    $model->logo=$filename;
//                }
            }
            $coun=Goods_Day_Count::findOne(['day'=>date('Ymd')]);
            if(empty($coun)){
                $coun=new Goods_Day_Count();
                $coun->day=date('Ymd');
                $coun->count=1;
                $model->sn=$coun->day.str_pad($coun->count,6,'0', STR_PAD_LEFT);
            }else{
                $model->sn=date('Ymd').str_pad($coun->count++ +1,6,'0', STR_PAD_LEFT);
            }
            $coun->save();
//            $d=date('Ymd');
//            $query=new Query();
//            echo $count=$query->from('goods')->count();
//            \Yii::$app->db->createCommand("INSERT INTO `goods_day_count` (day,`count`) VALUES ($d,$count+1) ON DUPLICATE KEY UPDATE `count`=$count+1")->execute();
            $model->save();
            if($intro->validate()){
                $intro->content=$model->content;
                $intro->goods_id=$model->id;
                $intro->save();
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['goods/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    //逻辑删除
    public function actionDel($id){
        $model=Goods::findOne($id);
        if($model==null){
            throw new NotFoundHttpException('商品不存在');
        }
        $model->updateAttributes(['status'=>0]);
        \Yii::$app->session->setFlash('danger','删除成功');
        return $this->redirect(['goods/index']);
    }
    public function actionEdit($id){
        $model=Goods::findOne($id);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
//            $model->imgFile=UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
//                if($model->imgFile){
//                    $filename='/images/'.uniqid().'.'.$model->imgFile->extension;
//                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$filename,false);
//                    $model->logo=$filename;
//                }
            }
            $model->save();
            \Yii::$app->session->setFlash('warning','修改成功');
            return $this->redirect(['goods/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionTest(){
        $i=1;
        echo date('Ymd').str_pad($i,6,'0', STR_PAD_LEFT);
//        $i++;
//        $model=new Goods_Day_Count();
//        $model->day=date('Ymd');
//        $model->count=3;
//        $model->save();
//        $d=date('Ymd');
//        $query=new Query();
//        echo $count=$query->from('goods')->count();

//        \Yii::$app->db->createCommand("INSERT INTO `goods_day_count` (day,`count`) VALUES ($d,2) ON DUPLICATE KEY UPDATE `count`=400")->execute();

    }
    public function actionGallery($id){
        $goods=Goods::findOne(['id'=>$id]);
        if($goods==null){
            throw new NotFoundHttpException('商品不存在');
        }
        return $this->render('gallery',['goods'=>$goods]);
    }
    public function actionLook($id){
        $model=Goods_Img::find()->where(['goods_id'=>$id])->all();
//        var_dump($model);exit;
        return $this->render('look',['model'=>$model,'id'=>$id]);
    }
    public function actionAddimg($id){
        $model=new Goods_Img();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加商品图片成功');
                return $this->redirect(['goods/look','id'=>$id]);
            }
        }
        return $this->render('addimg',['model'=>$model,'id'=>$id]);
    }
    public function actionEditimg($id){
//        $model=new Goods_Img();
        $model=Goods_Img::findOne($id);
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加商品图片成功');
                return $this->redirect(['goods/look','id'=>$id]);
            }
        }
        return $this->render('addimg',['model'=>$model,'id'=>$id]);
    }
    public function actionDelimg($id){
//        Goods_Img::findOne(['goods_id'=>$id])->delete();
        Goods_Img::find()->where(['goods_id'=>$id,'id'=>$id]);
        \Yii::$app->session->setFlash('danger','删除成功');
        return $this->redirect(['goods/look','id'=>$id]);
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
            ],
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
//                'format' => function (UploadAction $action) {
//                    $fileext = $action->uploadfile->getExtension();
//                    $filename = sha1_file($action->uploadfile->tempName);
//                    return "{$filename}.{$fileext}";
//                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png','gif'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
        ];
    }


}
