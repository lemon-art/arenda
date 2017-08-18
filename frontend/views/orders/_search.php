<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">
    <div class="card-header">
        <strong>Поиск</strong> 
    </div>
    <div class="card-block">

		<?php $form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
		]); ?>

		<div class="row">
            <div class="form-group col-sm-4">
				<label for="ccmonth">Номер заказа</label>
				<?= $form->field($model, 'order_id')->label(false); ?>
			</div>
			<div class="form-group col-sm-4">

				<label for="ccmonth">Начало аренды</label>
				<div class="row">
					<div class="form-group col-sm-3">
						<?=$form->field($model, 'data_start_from')->widget(DatePicker::className(), [
							'language' => 'ru',
							'dateFormat' => 'dd.MM.yyyy',
							'options' => [
								'class'=>'form-control datapicker',
							],
						]
						)->label(false); ?> 
					</div>
					<div>  - </div>
					<div class="form-group col-sm-3">
						<?=$form->field($model, 'data_start_to')->widget(DatePicker::className(), [
							'language' => 'ru',
							'dateFormat' => 'dd.MM.yyyy',
							'options' => [
								'class'=>'form-control datapicker',
							],
						]
						)->label(false); ?> 
					</div>
				</div>
			</div>
            <div class="form-group col-sm-4">
				<label for="ccmonth">Конец аренды</label>
				<div class="row">
					<div class="form-group col-sm-3">
						<?=$form->field($model, 'data_finish_from')->widget(DatePicker::className(), [
							'language' => 'ru',
							'dateFormat' => 'dd.MM.yyyy',
							'options' => [
								'class'=>'form-control datapicker',
							],
						]
						)->label(false); ?> 
					</div>
					<div>  - </div>
					<div class="form-group col-sm-3">
						<?=$form->field($model, 'data_finish_to')->widget(DatePicker::className(), [
							'language' => 'ru',
							'dateFormat' => 'dd.MM.yyyy',
							'options' => [
								'class'=>'form-control datapicker',
							],
						]
						)->label(false); ?> 
					</div>
				</div>
			</div>
		</div>
			

		<?/*<?= $form->field($model, 'person_id') ?>*/?>
		</div>
		<?php // echo $form->field($model, 'closed') ?>
		<div class="card-footer">
			<?= Html::submitButton('<i class="fa fa-dot-circle-o"></i> Найти', ['class' => 'btn btn-sm btn-primary']) ?>
			<?= Html::resetButton('<i class="fa fa-ban"></i> Сбросить', ['class' => 'btn btn-sm btn-danger']) ?>
        </div>

		<?php ActiveForm::end(); ?>

	
</div>
