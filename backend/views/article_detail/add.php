<?php
echo \yii\bootstrap\Html::a('返回',['article_detail/index'],['class'=>'btn btn-info btn-sm']);
$form=\yii\bootstrap\ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);
echo $form->field($model,'article_id')->textInput(['placeholder'=>'请输入文章id']);
echo $form->field($model,'content')->textarea(['placeholder'=>'简介']);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);

\yii\bootstrap\ActiveForm::end();