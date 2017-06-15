<div class="container">
    <table class="table table-responsive table-bordered table-hover table-striped table-condensed text-center">
        <tr>
            <td>ID</td>
            <td>日期</td>
            <td>商品数</td>
        </tr>
        <?php foreach ($model as $m):?>
            <tr>
                <td><?=$m->id?></td>
                <td><?=$m->day?></td>
                <td><?=$m->count?></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>