<div class="container">
    <!--<?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-heart"></span>添加',['user/add'],['class'=>'btn btn-danger btn-sm'])?>-->
    <table class="table table-responsive table-bordered table-hover table-striped table-condensed text-center">
        <tr>
            <td>ID</td>
            <td>用户名</td>
            <td>邮箱</td>
            <td>状态</td>
            <td>创建时间</td>
            <td>修改时间</td>
            <td>最后登录时间</td>
            <td>最后登录IP</td>
            <td>操作</td>
        </tr>
        <?php foreach ($model as $m):?>
        <tr>
            <td><?=$m->id?></td>
            <td><?=$m->username?></td>
            <td><?=$m->email?></td>
            <td><?=\backend\models\User::$options[$m->status]?></td>
            <td><?=date('Y-m-d H:i:s',$m->created_at)?></td>
            <td><?php if($m->updated_at==''){
                    echo '';
                }else{
                   echo date('Y-m-d H:i:s',$m->updated_at);
                }?></td>
            <td><?php if($m->last_time==''){
                    echo '';
                }else{
                    echo date('Y-m-d H:i:s',$m->last_time);
                }?></td>
            <td><?=$m->last_ip?></td>
            <td>
                <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-pencil"></span>修改密码',['user/rpw','id'=>$m->id],['class'=>'btn btn-primary btn-sm'])?>
                <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-picture"></span>编辑',['user/edit','id'=>$m->id],['class'=>'btn btn-warning btn-sm'])?>
                <?=\yii\bootstrap\Html::a('<span class="glyphicon glyphicon-trash"></span>删除',['user/del','id'=>$m->id],['class'=>'btn btn-info btn-sm'])?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    <?php
//            $user=\Yii::$app->user;
//            var_dump($user->identity);
//            echo '<br/>';
//            var_dump($user->id);
//            echo '<br/>';
//            var_dump($user->isGuest);
    ?>
</div>