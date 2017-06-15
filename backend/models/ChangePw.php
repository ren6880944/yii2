<?php
namespace backend\models;

use yii\base\Model;

class ChangePw extends Model{
    public $old_password;
    public $new_password;
    public $renew_password;
    public function rules()
    {
        return [
            [['old_password','new_password','renew_password'],'required'],
            ['old_password','validatePassword'],
            ['renew_password', 'compare', 'compareAttribute' => 'new_password', 'message'=>'两次密码必须一致'],
           [['new_password','renew_password'],'string','min'=>4,'tooShort'=>'密码长度至少4位'],
           [['new_password','renew_password'],'string','max'=>8,'tooLong'=>'密码长度最多8位'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'old_password'=>'旧密码',
            'new_password'=>'新密码',
            'renew_password'=>'确认新密码',
        ];
    }
    public function validatePassword(){
        $passwordHash=\Yii::$app->user->identity->password_hash;
        $password=$this->old_password;
                                                     //明文，    密文
        if(!\Yii::$app->security->validatePassword($password,$passwordHash)){
            $this->addError('old_password','旧密码不正确');
        }
    }
}