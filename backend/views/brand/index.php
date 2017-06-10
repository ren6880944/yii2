<div class="container">
    <?=\yii\bootstrap\Html::a('添加',['brand/add'],['class'=>'btn btn-primary btn-sm'])?>
    <table class="table table-bordered table-hover table-striped table-condensed text-center">
        <tr>
            <td>ID</td>
            <td>名称</td>
            <td>简介</td>
            <td>LOGO图片</td>
            <td>排序</td>
            <td>状态</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->id?></td>
                <td><?=$m->name?></td>
                <td><?=$m->intro?></td>
                <td><?=\yii\bootstrap\Html::img($m->logo,['class'=>'img-rounded','height'=>50])?></td>
                <td><?=$m->sort?></td>
                <td><?=\backend\models\Brand::$optionlist[$m->status]?></td>
                <td><?=\yii\bootstrap\Html::a('修改',['brand/edit','id'=>$m->id],['class'=>'btn btn-success btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('删除',['brand/del','id'=>$m->id],['class'=>'btn btn-danger btn-sm'])?></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>
<div style="width: 380px;margin: auto">
    <?=\yii\widgets\LinkPager::widget([
            'pagination'=>$pages,
            'nextPageLabel'=>'下一页',
            'prevPageLabel'=>'上一页',
            'firstPageLabel'=>'首页',
            'lastPageLabel'=>'末页',
    ])?>
</div>