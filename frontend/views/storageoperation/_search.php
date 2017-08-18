<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StorageOperationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="storage-operation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'storage_id') ?>

    <?= $form->field($model, 'operation_id') ?>

    <?= $form->field($model, 'operation_type') ?>

    <?= $form->field($model, 'contractor_type') ?>

    <?= $form->field($model, 'contractor_id') ?>

    <?php // echo $form->field($model, 'equipment_id') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'operation_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
