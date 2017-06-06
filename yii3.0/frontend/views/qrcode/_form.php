<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Qrcode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qrcode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'scene_id')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'add_time')->textInput() ?>

    <?= $form->field($model, 'scan_num')->textInput() ?>

    <?= $form->field($model, 'wechat_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'key_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scene_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qrcode_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticket')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
