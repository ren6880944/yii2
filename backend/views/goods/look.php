<div class="container">
    <?=\yii\helpers\Html::a('返回',['goods/index'],['class'=>'btn btn-info btn-sm'])?>
    <?=\yii\helpers\Html::a('添加图片',['goods/addimg','id'=>$id],['class'=>'btn btn-primary btn-sm'])?>
    <table class="table table-bordered table-responsive table-hover table-striped table-condensed text-center">
        <tr>
            <!--            <td>ID</td>-->
            <td>商品ID</td>
            <td>商品名称</td>
            <td>图片</td>
            <td>操作</td>
        </tr>
        <!--        --><?php //var_dump($model)?>
        <?php foreach ($model as $m):?>
            <tr>
            <!--<td><?/*=$m->id*/?></td>-->
            <td><?=$m->goods_id?></td>
            <td><?=$m->parent->name?></td>
            <td><?=\yii\bootstrap\Html::img($m->img,['class'=>'img img-rounded','width'=>80])?></td>
            <td>
                <?=\yii\helpers\Html::a('修改图片',['goods/editimg','id'=>$m->id,'goods_id'=>$id],['class'=>'btn btn-primary btn-sm'])?>
                <?=\yii\helpers\Html::a('删除图片',['goods/delimg','goods_id'=>$id,'id'=>$m->id],['class'=>'btn btn-danger btn-sm'])?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
