<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StorageConsist */

$this->title = $model->storage_id;
$this->params['breadcrumbs'][] = ['label' => 'Storage Consists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-consist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'storage_id' => $model->storage_id, 'equipment_id' => $model->equipment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'storage_id' => $model->storage_id, 'equipment_id' => $model->equipment_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'storage_id',
            'equipment_id',
            'presence',
            'leased',
            'total',
        ],
    ]) ?>

</div>
