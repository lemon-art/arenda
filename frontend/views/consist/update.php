<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StorageConsist */

$this->title = 'Update Storage Consist: ' . $model->storage_id;
$this->params['breadcrumbs'][] = ['label' => 'Storage Consists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->storage_id, 'url' => ['view', 'storage_id' => $model->storage_id, 'equipment_id' => $model->equipment_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="storage-consist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
