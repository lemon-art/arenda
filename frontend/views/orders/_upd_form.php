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
		
		<?
		$d = new DateTime( $model->data_start );
		$diff = $d->diff( new DateTime( $model->data_finish ) )->format("%d");
		?>
		<div id="arenda_days">
			<label class="control-label">Срок аренды (дней):</label>
			<span><?=$diff?></span>
		</div>
		
		<div class="form-group">
			<label class="control-label">Склад:</label>
			<span></span>
		</div>
		
		<div class="form-group">
			<label class="control-label">Клиент:</label>
			<a href="/clients/view?id=<?=$model->clients->person_id?>"><?=$model->clients->fullName?></a>
		</div>
		

		<?if ( $model->user_price ):?>
			<?= $form->field($model, 'summ')->textInput(['class' => 'w80', 'disabled' => false]);?>
		<?else:?>
			<?= $form->field($model, 'summ')->textInput(['class' => 'w80', 'disabled' => true]);?>
		<?endif;?>

		<div class="form-group">
			<?=$form->field($model, 'user_price')->checkbox();?>
		</div>
		
		<?= $form->field($model, 'person_id')->hiddenInput()->label(false);?>
		<?= $form->field($model, 'storage_id')->hiddenInput()->label(false);?>

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
		
		<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products_old">
            <thead class="thead-default">
                <tr>
                    <th class="text-xs-center">№</th>
                    <th>Наименование</th>
                    <th>Стоимость аренды</th>
                    <th class="text-xs-center">Кол-во</th> 
                    <th>Цена в день</th>
					<th></th>
                </tr>
            </thead>
			<tbody>
				<?$daySumm = 0; $allSumm = 0;?>
				<?foreach ( $arEqip as $key => $asEq):?>
					<tr>
						<td><?=$key+1?></td>
						<td><?=$asEq["equipment"]["name"]?></td>
						<td  class="product_price"><?=$asEq["equipment"]["arenda"]?></td>
						<td><input class="product_count" type="number" min="0" max="" size="3" name="eq[<?=$asEq["equipment_id"]?>]" value="<?=$asEq["count"]?>"></td>
						<td class="total_count"><?=$asEq["equipment"]["arenda"]*$asEq["count"]?></td>
						<td><span class="glyphicon glyphicon-remove delete-tr"></span></td>
					</tr>
					<?$daySumm += $asEq["equipment"]["arenda"]*$asEq["count"];?>
				<?endforeach;?>
			</tbody>
		</table>

		<div id="products_div">
			<h3>Добавленные товары в заказ</h3>
			
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
		</div>
		
		<div id="itog_day" style="display: block">Итого (руб. в день): <span><?=$daySumm?></span> </div>
		<div id="itog_all" style="display: block">Всего (руб.): <span><?=$daySumm*$diff?></span> </div>
		
		<div class="form-group"> 
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
