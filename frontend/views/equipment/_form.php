<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<?
if ( $type ){
	$model -> type = $type;
}
?>

<div class="card-block">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'sort')->textInput() ?> 

	<?= $form->field($model, 'type')->dropDownList($model->GetDropdownSections());?>

    <?= $form->field($model, 'arenda')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>  
	
	<?= $form->field($model, 'weight')->textInput() ?>
	


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
