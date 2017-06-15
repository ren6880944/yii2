<?php

namespace backend\controllers;

use backend\models\Goods_Category;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class Goods_categoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model=Goods_Category::find()->all();
        return $this->render('index',['model'=>$model]);
    }
    //添加
    public function actionAdd(){
        $model=new Goods_Category();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //判断是否是添加一级分类(parent_id是否为0)
            if($model->parent_id){
                //添加非一级分类
                $parent=Goods_Category::findOne(['id'=>$model->parent_id]);
                $model->prependTo($parent);//添加到上一级分类下面
            }else{
                //添加一级分类
                $model->makeRoot();
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['goods_category/index']);
        }
        //获取所有分类选项
        $categories=ArrayHelper::merge([['id'=>0,'name'=>'顶级分类','parent_id'=>0]],Goods_Category::find()->asArray()->all());
        return $this->render('add',['model'=>$model,'categories'=>$categories]);
    }
    //修改
    public function actionEdit($id){
        $model=Goods_Category::findOne($id);
        if($model==null){
            throw new NotFoundHttpException('分类不存在');
        }
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //判断是否是添加一级分类(parent_id是否为0)
            if($model->parent_id){
                //添加非一级分类
                $parent=Goods_Category::findOne(['id'=>$model->parent_id]);
                $model->prependTo($parent);//添加到上一级分类下面
            }else{
                //添加一级分类
                $model->makeRoot();
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['goods_category/index']);
        }
        //获取所有分类选项
        $categories=ArrayHelper::merge([['id'=>0,'name'=>'顶级分类','parent_id'=>0]],Goods_Category::find()->asArray()->all());
        return $this->render('add',['model'=>$model,'categories'=>$categories]);
    }
    public function actionTest(){
//        $jydq = new Goods_Category();
//        $jydq->name = '家用电器';
//        $jydq->parent_id = 0;
//        $jydq->makeRoot();//将当前分类设置为一级分类
//        var_dump($jydq);

        //创建二级分类
//        $parent=Goods_Category::findOne(1);
//        $xjd=new Goods_Category();
//        $xjd->name='小家电';
//        $xjd->parent_id=$parent->id;
//        $xjd->prependTo($parent);
//
//        //获取一级分类
//        $root=Goods_Category::find()->roots()->all();
//        var_dump($root);

        //获取该分类下面的所有子孙分类
//        $parent=Goods_Category::findOne(1);
//        $children=$parent->leaves()->all();
//        var_dump($children);
    }
    public function actionZtree(){
        $categories=Goods_Category::find()->asArray()->all();
        return $this->renderPartial('ztree',['categories'=>$categories]);
    }
}
