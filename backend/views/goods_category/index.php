<div class="container">
    <?=\yii\bootstrap\Html::a('添加',['goods_category/add'],['class'=>'btn btn-primary btn-sm'])?>
    <table class="table table-bordered table-responsive table-hover table-striped table-condensed text-center">
        <tr>
            <td>ID</td>
            <td>名称</td>
            <td>上级分类id</td>
            <td>简介</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->id?></td>
                <td><?=$m->name?></td>
                <td><?=$m->parent?$m->parent->name:''?></td>
                <td><?=$m->intro?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('修改',['goods_category/edit','id'=>$m->id],['class'=>'btn btn-warning btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('删除',['goods_category/del','id'=>$m->id],['class'=>'btn btn-danger btn-sm'])?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>