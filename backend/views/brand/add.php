<?php
use yii\web\JsExpression;
echo \yii\bootstrap\Html::a('返回',['brand/index'],['class'=>'btn btn-warning btn-sm']);
$form=\yii\bootstrap\ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);
echo $form->field($model,'name')->textInput(['placeholder'=>'请输入名称']);
echo $form->field($model,'intro')->textarea(['placeholder'=>'请输入简介']);
echo $form->field($model,'logo')->hiddenInput();
//echo $form->field($model,'imgFile')->fileInput();
echo \yii\bootstrap\Html::fileInput('test',null,['id'=>'test']);
echo \xj\uploadify\Uploadify::widget([
    'url' => yii\helpers\Url::to(['s-upload']),
    'id' => 'test',
    'csrf' => true,
    'renderTag' => false,
    'jsOptions' => [
        'width' => 120,
        'height' => 40,
        'onUploadError' => new JsExpression(<<<EOF
function(file, errorCode, errorMsg, errorString) {
    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
}
EOF
        ),
        'onUploadSuccess' => new JsExpression(<<<EOF
function(file, data, response) {
    data = JSON.parse(data);
    if (data.error) {
        console.log(data.msg);
    } else {
        console.log(data.fileUrl);
        //将上传成功后的图片地址(data.fileUrl)写入img标签
        $("#img_logo").attr("src",data.fileUrl).show();
        //将上传成功后的图片地址(data.fileUrl)写入logo字段
        $("#brand-logo").val(data.fileUrl);
    }
}
EOF
        ),
    ]
]);
if($model->logo){
    echo \yii\helpers\Html::img('@web'.$model->logo,['height'=>80]);
}else{
    echo \yii\helpers\Html::img('',['style'=>'display:none','id'=>'img_logo','height'=>80]);
}
echo $form->field($model,'sort')->textInput(['placeholder'=>'请输入排序数字']);
echo $form->field($model,'status')->radioList(\backend\models\Brand::$optionlist);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);
\yii\bootstrap\ActiveForm::end();