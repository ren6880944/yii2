<?php
use yii\web\JsExpression;
use xj\uploadify\Uploadify;
use kartik\select2\Select2;

echo \yii\bootstrap\Html::a('回退',['goods/index'],['class'=>'btn btn-info btn-sm']);
$form=\yii\bootstrap\ActiveForm::begin(
//    [
//        'id' => 'login-form',
//        'options' => ['class' => 'form-horizontal'],
//        'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
//        ],
//    ]
);
echo $form->field($model,'name')->textInput(['placeholder'=>'商品名称']);
//echo $form->field($model,'sn')->textInput();
//echo $form->field($model,'imgFile')->fileInput(['id'=>'test']);
echo $form->field($model,'logo')->hiddenInput();
//外部TAG
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
        $("#goods-logo").val(data.fileUrl);
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

echo $form->field($model,'goods_category_id')->dropDownList(\backend\models\Goods::getOptions(),['prompt'=>'=请选择商品分类=']);
echo $form->field($model,'brand_id')->dropDownList(\backend\models\Goods::getBrand(),['prompt'=>'=请选择品牌分类=']);
echo $form->field($model,'market_price')->textInput(['placeholder'=>'市场价格']);
echo $form->field($model,'shop_price')->textInput(['placeholder'=>'本店价格']);
echo $form->field($model,'stock')->textInput(['placeholder'=>'库存']);
echo $form->field($model,'is_on_sale',['inline'=>true])->radioList(\backend\models\Goods::$sale);
echo $form->field($model,'status',['inline'=>true])->radioList(\backend\models\Goods::$status);
echo $form->field($model,'sort')->textInput(['placeholder'=>'排序']);
echo $form->field($model,'content')->widget('kucha\ueditor\UEditor',[]);


echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);


\yii\bootstrap\ActiveForm::end();