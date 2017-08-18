<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StorageOperation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="storage-operation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'storage_id')->textInput() ?>

    <?= $form->field($model, 'operation_type')->dropDownList([ 'lease' => 'Lease', 'refund' => 'Refund', 'reject' => 'Reject', 'debtor' => 'Debtor', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'contractor_type')->dropDownList([ 'legal' => 'Legal', 'person' => 'Person', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'contractor_id')->textInput() ?>

    <?= $form->field($model, 'equipment_id')->textInput() ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'operation_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
