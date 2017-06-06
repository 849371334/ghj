<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wechat_id')->textInput() ?>

    <?= $form->field($model, 'kf_id')->textInput() ?>

    <?= $form->field($model, 'accepted_case')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'kf_nick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kf_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kf_headimgurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kf_wx')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
