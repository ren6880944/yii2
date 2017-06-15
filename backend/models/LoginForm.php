<?php
namespace backend\models;

use yii\base\Model;

class LoginForm extends Model{
    public $username;
    public $password_hash;
    public $code;

    public function rules()
    {
        return [
            [['username','password_hash'],'required'],
            [['username','password_hash'],'validateUsername'],
            ['code','captcha']
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password_hash'=>'密码',
            'code'=>'验证码'
        ];
    }
    public function validateUsername(){
        $user=User::findOne(['username'=>$this->username]);
        if($user){
            $pw=\Yii::$app->security->validatePassword($this->password_hash,$user->password_hash);
            if($pw){
                \Yii::$app->user->login($user);
            }else{
                $this->addError('username','账号或者密码错误');
            }
        }else{
            $this->addError('username','账号或者密码错误');
        }
    }
}