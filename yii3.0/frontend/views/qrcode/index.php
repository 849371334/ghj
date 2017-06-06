<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qrcodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qrcode-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Qrcode', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'scene_id',
            'end_time:datetime',
            'add_time:datetime',
            // 'scan_num',
            // 'wechat_id',
            // 'type',
            // 'status',
            // 'sort',
            // 'key_name',
            // 'scene_name',
            // 'qrcode_url:url',
            // 'ticket',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
