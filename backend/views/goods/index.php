<div class="container">
    <div class="text-center">
        <?php
            $form=\yii\bootstrap\ActiveForm::begin([
                'method'=>'get',
                'action'=>\yii\helpers\Url::to(['goods/index']),
                'options'=>['class'=>'form-inline'],
            ]);
            echo $form->field($models,'name')->textInput(['placeholder'=>'商品名称'])->label(false);
            echo $form->field($models,'sn')->textInput(['placeholder'=>'货号'])->label(false);
            echo $form->field($models,'min_price')->textInput(['placeholder'=>'最小价格'])->label(false);
            echo $form->field($models,'max_price')->textInput(['placeholder'=>'最大价格'])->label(false);
            echo \yii\bootstrap\Html::submitInput('搜索',['class'=>'btn btn-primary btn-sm']);
            \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
    <?=\yii\bootstrap\Html::a('添加',['goods/add'],['class'=>'btn btn-info btn-sm'])?>
    <table class="table table-bordered table-responsive table-hover table-striped table-condensed text-center">
        <tr>
            <td>ID</td>
            <td>商品名称</td>
            <td>货号</td>
            <td>LOGO图片</td>
            <td>商品分类</td>
            <td>品牌分类</td>
            <td>市场价格</td>
            <td>本店价格</td>
            <td>库存</td>
            <td>是否在售</td>
            <td>状态</td>
            <td>排序</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->id?></td>
                <td><?=$m->name?></td>
                <td><?=$m->sn?></td>
                <td><?=\yii\bootstrap\Html::img($m->logo,['class'=>'img-rounded','width'=>60])?></td>
                <td><?=$m->parent->name?></td>
                <td><?=$m->bparent->name?></td>
                <td><?=$m->market_price?></td>
                <td><?=$m->shop_price?></td>
                <td><?=$m->stock?></td>
               <!-- <td><?/*=\backend\models\Goods::$sale[$m->is_on_sale]*/?></td>
                <td><?/*=\backend\models\Goods::$status[$m->status]*/?></td>-->
               <td><?=$m->is_on_sale==1?'在售':'下架'?></td>
                <td><?=$m->status==1?'正常':'回收'?></td>
                <td><?=$m->sort?></td>
                <td><?=date('Y-m-d H:i:s',$m->create_time)?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-picture"></span>相册',['gallery','id'=>$m->id],['class'=>'btn btn-default btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-edit"></span>编辑',['goods/edit','id'=>$m->id],['class'=>'btn btn-default btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-trash"></span>删除',['goods/del','id'=>$m->id],['class'=>'btn btn-default btn-sm'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <div class="text-center">
        <?=\yii\widgets\LinkPager::widget([
                'pagination'=>$pages,
                'nextPageLabel'=>'下一页',
                'prevPageLabel'=>'上一页',
                'firstPageLabel'=>'首页',
                'lastPageLabel'=>'末页',
        ])?>
    </div>
</div>