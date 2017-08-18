<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StorageOperation */

$this->title = $model->operation_id;
$this->params['breadcrumbs'][] = ['label' => 'Storage Operations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-operation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->operation_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->operation_id], [
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
            'operation_id',
            'operation_type',
            'contractor_type',
            'contractor_id',
            'equipment_id',
            'count',
            'user_id',
            'operation_date',
        ],
    ]) ?>

</div>
