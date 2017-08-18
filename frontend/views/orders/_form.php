<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\jui\AutoComplete;
use app\models\Clients;
use app\models\Storage;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */


?>


    <div class="card-block">

		<?php $form = ActiveForm::begin(); ?>


		
		<?=$form->field($model, 'data_start')->widget(DatePicker::className(), [
			'language' => 'ru',
			'dateFormat' => 'dd.MM.yyyy',
		]) ?> 
		
		<?=$form->field($model, 'data_finish')->widget(DatePicker::className(), [
			'language' => 'ru',
			'dateFormat' => 'dd.MM.yyyy',
		]) ?> 
		
		<div id="arenda_days" class="form-group" style="display: none;">
			<label class="control-label">Срок аренды (дней):</label>
			<span></span>
		</div>
		
		
		
		<div class="form-group">
			<?= $form->field($model, 'storage_id')->dropDownList(Storage::GetStorages());?>
		</div>
		
		
		<?= $form->field($model, 'client_name')->widget(
			AutoComplete::className(), [            
				'clientOptions' => [
					'source' => Clients::GetClientList(),
					'minLength'=>'2',
					'select' => new JsExpression("function( event, ui ) {
						$('#orders-person_id').val(ui.item.id);
					}")
				],
				'options' => [
					'class'=>'form-control w300',
				],
			]);
		?>
		<?/*
		<?= Html::a('Добавить клиента', ['clients/create'], [
				'class' => '',
				'id' => 'activity-view-link',
				'title' => 'Новый клиент',
				'data-toggle' => 'modal',
				'data-target' => '#ModalForm',
				'data-id' => 'new_client',										
				'data-pjax' => '0',
				'data-remote' => ['clients/create']
		]); ?>
		*/?>

		<?= $form->field($model, 'summ')->textInput(['class' => 'w80', 'disabled' => true]);?>
		
		<?= $form->field($model, 'person_id')->hiddenInput()->label(false);?>
		<div class="form-group">
			<?=$form->field($model, 'user_price')->checkbox();?>
		</div>

		<h3>Товары в заказе</h3>
		<?= Html::a('Добавить товары', ['equipment/storageset?id=1'], [
				'class' => '',
				'id' => 'activity-view-link', 
				'title' => 'Добавить товары к заказу',
				'data-toggle' => 'modal',
				'data-target' => '#SelectModalForm',
				'data-id' => 'new_client',										
				'data-pjax' => '0',
				'data-remote' => ['equipment/create?storage_id=1']
		]); ?>
		<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
            <thead class="thead-default">
                <tr>
                    <th class="text-xs-center">№</th>
                    <th>Наименование</th>
                    <th class="text-xs-center">Доступно</th>
                    <th>Стоимость аренды</th>
                    <th class="text-xs-center">Кол-во</th> 
                    <th>Цена в день</th>
					<th></th>
                </tr>
            </thead>
            <tbody>
			</tbody>
		</table>
		<div id="itog_day">Итого (руб. в день): <span></span> </div>
		<div id="itog_all">Всего (руб.): <span></span> </div>
		
		
		<div class="form-group"> 
			<?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
		
		<div id="res">
		
		</div>
		
		

		<?php ActiveForm::end(); ?>
	</div>



	<?php
	\yii\bootstrap\Modal::begin([
		'headerOptions' => ['class'=>'text-center'],
		'id' => 'SelectModalForm',
		'size' => 'modal-lg',
		'options'=>['style'=>'min-width:700px']
	]);?>


	<? \yii\bootstrap\Modal::end()?>
	
	<? \yii\bootstrap\Modal::begin(['id'=>'ModalForm'])?>
	<? \yii\bootstrap\Modal::end()?>
