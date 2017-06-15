<?php
use yii\web\JsExpression;
use xj\uploadify\Uploadify;
$form=\yii\bootstrap\ActiveForm::begin();
echo \yii\bootstrap\Html::a('返回',['goods/look','id'=>$id],['class'=>'btn btn-info btn-sm']);
//var_dump($id);
echo $form->field($model,'goods_id')->textInput(['value'=>$id]);
echo $form->field($model,'img')->hiddenInput();
echo \yii\bootstrap\Html::fileInput('test', NULL, ['id' => 'test']);
echo Uploadify::widget([
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
        //将上传成功的图片地址写入img标签
        $("#img_logo").attr("src",data.fileUrl).show();
        //将上传成功后的图片地址(data.fileUrl)写入logo字段
        $("#goods_img-img").val(data.fileUrl);
    }
}
EOF
        ),
    ]
]);
if($model->img){
    echo \yii\helpers\Html::img('@web'.$model->img,['height'=>80]);
}else{
    echo \yii\helpers\Html::img('',['style'=>'display:none','id'=>'img_logo','height'=>80]);
}
echo '<br/>';
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);
\yii\bootstrap\ActiveForm::end();