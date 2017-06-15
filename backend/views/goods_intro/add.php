<?php
echo \yii\bootstrap\Html::a('返回',['goods_intro/index'],['class'=>'btn btn-primary btn-sm']);
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'goods_id')->textInput(['placeholder'=>'商品id']);
//echo $form->field($model,'content')->textarea(['placeholder'=>'商品描述']);

echo $form->field($model,'content')->widget('kucha\ueditor\UEditor',[]);
echO \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-info btn-sm']);
\yii\bootstrap\ActiveForm::end();