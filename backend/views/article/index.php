<div class="container">
    <?=\yii\bootstrap\Html::a('新增',['article/add'],['class'=>'btn btn-primary btn-sm'])?>
    <table class="table table-bordered table-responsive table-hover table-striped table-condensed">
        <tr>
            <td>ID</td>
            <td>名称</td>
            <td>简介</td>
            <td>文章分类ID</td>
            <td>排序</td>
            <td>状态</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->id?></td>
                <td><?=$m->name?></td>
                <td><?=$m->intro?></td>
                <td><?=$m->article_category_id?></td>
                <td><?=$m->sort?></td>
                <td><?=\backend\models\Article::$optionlists[$m->status]?></td>
                <td><?=date('Y-m-d H:i:s',$m->create_time)?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('修改',['article/edit','id'=>$m->id],['class'=>'btn btn-warning btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('删除',['article/del','id'=>$m->id],['class'=>'btn btn-danger btn-sm'])?>
                </td>
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