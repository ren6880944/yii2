<div class="container">
    <?=\yii\bootstrap\Html::a('添加',['goods_intro/add'],['class'=>'btn btn-info btn-sm'])?>
    <table class="table table-responsive table-bordered table-hover table-condensed  table-striped text-center">
        <tr>
            <td>ID</td>
            <td>商品ID</td>
            <td>商品描述</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->id?></td>
                <td><?=$m->goods_id?></td>
                <td><?=htmlspecialchars(mb_substr($m->content,0,50,'utf-8').'.....')?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('查看商品介绍',['goods_intro/look','id'=>$m->id],['class'=>'btn btn-info btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('修改',['goods_intro/edit','id'=>$m->id],['class'=>'btn btn-primary btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('删除',['goods_intro/del','id'=>$m->id],['class'=>'btn btn-danger btn-sm'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>