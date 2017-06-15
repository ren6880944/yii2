<?php
$form=\yii\bootstrap\ActiveForm::begin(
    [
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]
);
echo $form->field($model,'username')->textInput(['placeholder'=>'请输入用户名']);
echo $form->field($model,'password_hash')->passwordInput(['placeholder'=>'请输入密码']);
echo $form->field($model,'code')->widget(\yii\captcha\Captcha::className());
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']).'  ' ;
echo \yii\bootstrap\Html::a('注册',['user/add'],['class'=>'btn btn-primary btn-sm']);
\yii\bootstrap\ActiveForm::end();