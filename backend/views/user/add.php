<?php
$form=\yii\bootstrap\ActiveForm::begin(
    [
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]
);
//echo \yii\bootstrap\Html::a('返回',['user/index'],['class'=>'btn btn-info btn-sm']);
echo $form->field($model,'username')->textInput(['placeholder'=>'用户名']);
echo $form->field($model,'password_hash')->passwordInput(['placeholder'=>'密码']);
echo $form->field($model,'email')->textInput(['placeholder'=>'email']);
echo $form->field($model,'status',['inline'=>true])->radioList(\backend\models\User::$options);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);


\yii\bootstrap\ActiveForm::end();