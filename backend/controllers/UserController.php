<?php

namespace backend\controllers;

use backend\models\ChangePw;
use backend\models\LoginForm;
use backend\models\User;
use yii\web\Request;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model=User::find()->all();
        return $this->render('index',['model'=>$model]);
    }
    public function actionAdd(){
        $model=new User();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->password_hash=\Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
//            var_dump(\Yii::$app->request->post());exit;
            $model->save();
            \Yii::$app->session->setFlash('success','注册成功');
            return $this->redirect(['user/login']);
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id){
        $model=User::findOne($id);
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->password_hash=\Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
//            var_dump(\Yii::$app->request->post());exit;
            $model->save();
            \Yii::$app->session->setFlash('success','修改成功');
            return $this->redirect(['user/index']);
        }
        $model->password_hash='';
        return $this->render('add',['model'=>$model]);
    }
    public function actionDel($id){
        User::findOne($id)->delete();
        \Yii::$app->session->setFlash('danger','删除成功');
        return $this->redirect(['user/index']);
    }

    public function actionTest(){
        echo \Yii::$app->request->userIP;
        echo '<br/>';
        //实例化user组件
        $user = \Yii::$app->user;
        //获取当前登录用户实例(如果当前用户已登录)
        var_dump($user->identity);
        echo '<br/>';
        //获取当前登录用户的id
        var_dump($user->id);
        echo '<br/>';
        //判断当前用户是否是游客（未登录）
        var_dump($user->isGuest);
    }
    public function actionDl(){
//        $a=11;
//        $person = \Yii::$app->user->login();
//        var_dump($person);
    }
    public function actionLogin(){
        $model=new LoginForm();
//        $request=new Request();
//        if($request->isPost){
//            $model->load($request->post());
//            if($model->validate()){
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
                \Yii::$app->db->createCommand()->update('user',['last_time'=>time()],['id'=>\Yii::$app->user->id])->execute();
                \Yii::$app->db->createCommand()->update('user',['last_ip'=>\Yii::$app->request->userIP],['id'=>\Yii::$app->user->id])->execute();
                \Yii::$app->session->setFlash('success','登录成功');
                return $this->redirect(['user/index']);
            }

        return $this->render('login',['model'=>$model]);
    }
    public function actionRpw(){
        $model=new ChangePw();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $account=\Yii::$app->user->identity;
                $account->password_hash=$model->new_password;
                if($account->save(false)){
                    \Yii::$app->session->setFlash('success','密码修改成功');
                    return $this->redirect(['user/index']);
                }else{
                    var_dump($account->getErrors());exit;
                }
            }
        }
        return $this->render('rpw',['model'=>$model]);
    }
}
