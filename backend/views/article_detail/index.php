<div class="container">
    <?=\yii\bootstrap\Html::a('添加',['article_detail/add'],['class'=>'btn btn-primary btn-sm'])?>
    <table class="table table-responsive table-bordered table-hover table-striped table-condensed">
        <tr>
            <td>文章ID</td>
            <td>简介</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->article_id?></td>
                <td><?=$m->content?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('修改',['article_detail/edit','article_id'=>$m->article_id],['class'=>'btn btn-warning btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('删除',['article_detail/del','article_id'=>$m->article_id],['class'=>'btn btn-danger btn-sm'])?>
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