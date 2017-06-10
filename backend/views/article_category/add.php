<?php
echo \yii\bootstrap\Html::a('返回',['article_category/index'],['class'=>'btn btn-info btn-sm']);
$form=\yii\bootstrap\ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);
echo $form->field($model,'name')->textInput(['placeholder'=>'请输入文章类型名称']);
echo $form->field($model,'intro')->textarea(['placeholder'=>'请输入简介']);
echo $form->field($model,'sort')->textInput(['placeholder'=>'请输入排序数字']);
echo $form->field($model,'status')->radioList(\backend\models\Article_Category::$optionlists);
echo $form->field($model,'is_help')->textInput(['placeholder'=>'请输入类型']);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);

\yii\bootstrap\ActiveForm::end();