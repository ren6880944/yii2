<style>
    td{
        text-align: center;
    }
</style>
<div class="container">
    <?=\yii\bootstrap\Html::a('添加',['article_category/add'],['class'=>'btn btn-primary btn-sm'])?>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <td>ID</td>
            <td>名称</td>
            <td>简介</td>
            <td>排序</td>
            <td>状态</td>
            <td>类型</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->id?></td>
                <td><?=$m->name?></td>
                <td><?=$m->intro?></td>
                <td><?=$m->sort?></td>
                <td><?=\backend\models\Article_Category::$optionlists[$m->status]?></td>
                <td><?=$m->is_help?></td>
                <td>
                    <?=\yii\bootstrap\Html::a('修改',['article_category/edit','id'=>$m->id],['class'=>'btn btn-info btn-sm'])?>
                    <?=\yii\bootstrap\Html::a('删除',['article_category/del','id'=>$m->id],['class'=>'btn btn-danger btn-sm'])?>
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