<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'old_password')->passwordInput(['旧密码']);
echo $form->field($model,'new_password')->passwordInput(['新密码']);
echo $form->field($model,'renew_password')->passwordInput(['确认新密码']);
echo \yii\bootstrap\Html::submitInput('提交',['class'=>'btn btn-primary btn-sm']);
\yii\bootstrap\ActiveForm::end();
