<?php
/**
 * @var $this\yii\web\View
 */
echo \yii\bootstrap\Html::a('返回',['goods_category/index'],['class'=>'btn btn-info btn-sm']);
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
echo $form->field($model,'name')->textInput(['placeholder'=>'请输入分类名称']);
echo $form->field($model,'parent_id')->hiddenInput();
echo '<ul id="treeDemo" class="ztree"></ul>';
echo $form->field($model,'intro')->textarea(['plcaeholder'=>'简介']);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);
\yii\bootstrap\ActiveForm::end();

//使用ztree，加载2个静态资源
$this->registerCssFile('@web/zTree/css/zTreeStyle/zTreeStyle.css');
$this->registerJsFile('@web/zTree/js/jquery.ztree.core.js',['depends'=>\yii\web\JqueryAsset::className()]);
$zNodes=\yii\helpers\Json::encode($categories);
$js=new \yii\web\JsExpression(
    <<<JS
var zTreeObj;
    // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
    var setting = {
        data: {
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "parent_id",
                rootPId: 0
            }
        },
        callback:{
            onClick:function(event, treeId, treeNode) {
                console.log(treeNode.id);
                //将选中节点的ID赋值给表单parent_id
                $('#goods_category-parent_id').val(treeNode.id);
            }
        }
    };
    // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
    var zNodes = {$zNodes};
   
        zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        zTreeObj.expandAll(true);
        //获取当前节点的父节点（根据id查找）
        var node = zTreeObj.getNodeByParam("id", $('#goods_category-parent_id').val(), null);
        zTreeObj.selectNode(node);
JS

);
$this->registerJs($js);
?>
