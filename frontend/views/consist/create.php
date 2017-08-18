<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StorageConsist */

$this->title = 'Create Storage Consist';
$this->params['breadcrumbs'][] = ['label' => 'Storage Consists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-consist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
