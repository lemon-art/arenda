<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Storage Consists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-consist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Storage Consist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'storage_id',
            'equipment_id',
            'presence',
            'leased',
            'total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
