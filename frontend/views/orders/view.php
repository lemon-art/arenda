<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Заказ №'. $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	<div class="card">
        <div class="card-header">
            <?=$this->title?>
        </div>
        <div class="card-block">
			<div class="row">
				<div class="form-group col-sm-6">
		
					<div class="form-group">
						<label class="control-label">Дата аренды:</label> <?=$model->data_start?> - <?=$model->data_finish?>
					</div>
					<div class="form-group">
						<?
						$d = new DateTime( $model->data_start );
						$diff = $d->diff( new DateTime( $model->data_finish ) )->format("%d");
						?>
						<label class="control-label">Срок аренды:</label> <?=$diff?>
					</div>
					<?/*
					<div class="form-group">
						<label class="control-label">Склад:</label> <?//=$model->stotage->name?>
					</div>
					*/?>
					<div class="form-group">
						<label class="control-label">Стоимость:</label> <?=$model->summ?> руб.
					</div>
					
				</div>
				<div class="form-group col-sm-6">
					<div class="card">
                        <div class="card-header">
                            Клиент
                        </div>
                        <div class="card-block">
							<div class="form-group">
								<label class="control-label">ФИО:</label> <a href="/clients/view?id=<?=$model->clients->person_id?>"><?=$model->clients->fullName?></a>
							</div>
							<div class="form-group">
								<label class="control-label">Телефон:</label> <?=$model->clients->phone?>
							</div>
						</div>
					</div>
				</div>
			</div>


			
			<?if ( count ( $arEqip )> 0):?>
				<br><br>
				<h3>Товары в заказе</h3>
				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">№</th>
							<th>Наименование</th>
							<th>Стоимость аренды</th>
							<th class="text-xs-center">У клиента</th> 
							<th class="text-xs-center">Возвращено</th>
							<th>Цена в день</th>
						</tr>
					</thead>
					<tbody>
						<?foreach ( $arEqip as $key => $asEq):?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$asEq["equipment"]["name"]?></td>
								<td><?=$asEq["equipment"]["arenda"]?></td>
								<td><?=$asEq["count"]?></td>
								<td><?=$asEq["returned"]?></td>
								<td><?=$asEq["equipment"]["arenda"]*$asEq["count"]?></td>
							</tr>
						<?endforeach;?>
					</tbody>
				</table>
			<?endif;?> 
			
			<?= Html::a('Вернуть все', ['returnall', 'id' => $model->order_id], [
				'class' => 'btn btn-success',
				'data' => [
					'confirm' => 'Клиент вернул все товары по заказу?',
					'method' => 'post',
				],
			]) ?>
			<?= Html::a('Вернуть часть', ['return', 'id' => $model->order_id], ['class' => 'btn btn-outline-primary']) ?>
			
			<br><br>
			<h3 id="payment">Оплаты по заказу</h3>
			
			<?if ( count ( $arPayments )> 0):?>

				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="payments">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">Дата</th>
							<th>Сумма (руб.)</th>
							<th>Способ оплаты</th>
							<th>Менеджер</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?foreach ( $arPayments as $key => $arPayment):?>
							<tr>
								<td><?=date("d.m.Y",strtotime($arPayment['data']))?></td>
								<td><?=$arPayment["summ"]?></td>
								<td>
									<?
									switch ( $arPayment['type'] ) {
										case 'nal':
											echo "наличные";
											break;
										case 'beznal':
											echo "безнал";
											break;
										case "debtor":
											echo "Возвращено";
											break;
									}
									?>
									
								</td>
								<td></td>
								<td>
									<?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['payment/update?id='.$arPayment['id'].'&order_id='.$model->order_id], [
										'class' => '',
										'id' => 'activity-view-link',
										'title' => 'Оплата по заказу №'.$model->order_id,
										'data-toggle' => 'modal',
										'data-target' => '#ModalForm',
										'data-id' => 'new_client',										
										'data-pjax' => '0',
										'data-remote' => ['payment/create']
									]); ?>
									<?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['payment/delete?id='.$arPayment['id'].'&order_id='.$model->order_id], [
										'class' => '',
										'data' => [
											'confirm' => 'Удалить оплату?',
											'method' => 'post',
										],
									]) ?>
									
								</td>
							</tr>
						<?endforeach;?>
					</tbody>
				</table>
			<?else:?>	
				<p>Оплат по заказу не поступало</p>
			<?endif;?>
			<?= Html::a('Добавить оплату', ['payment/create?order_id='.$model->order_id], [
				'class' => 'btn btn-success',
				'id' => 'activity-view-link',
				'title' => 'Оплата по заказу №'.$model->order_id,
				'data-toggle' => 'modal',
				'data-target' => '#ModalForm',
				'data-id' => 'new_client',										
				'data-pjax' => '0',
				'data-remote' => ['payment/create']
			]); ?>
			
			
			
			<?if ( count ( $arOperations )> 0):?>
				<br><br>
				<?
					$arOperationDate = Array();
					foreach ( $arOperations as $key => $asOperation){
						$date = date("d.m.Y",strtotime($asOperation['operation_date']));
						$type = $asOperation['operation_type'];
						
						$arOperationDate[$type][$date][$asOperation["equipment"]["equipment_id"]] = $asOperation["count"];
					}
				
				?>
				
				<br>
				<h3>Операции по заказу</h3>
				<br>
				<h4>Выдано</h4>
				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">Наименование</th>
							<?foreach ( $arOperationDate['lease'] as $date => $val):?>
								<th><?=$date?></th>
							<?endforeach;?>
							<th>Итого</th>
						</tr>
						<tbody>
							<?foreach ( $arEqip as $key => $asEq):?>
								<tr>
									<td><?=$asEq["equipment"]["name"]?></td>
									<?$itogo = 0;?>
									<?foreach ( $arOperationDate['lease'] as $date => $arVal):?>
										<td align="center" width="70"><?=$arVal[$asEq["equipment_id"]]?></td>
										<?$itogo += $arVal[$asEq["equipment_id"]];?>
									<?endforeach;?>
									
									<td align="center" width="70"><?=$itogo?></td>
								</tr>	
							<?endforeach;?>
					</thead>
				</table>
				<br>
				<h4>Возвращено</h4>
				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">Наименование</th>
							<?foreach ( $arOperationDate['debtor'] as $date => $val):?>
								<th><?=$date?></th>
							<?endforeach;?>
							<th>Итого</th>
						</tr>
						<tbody>
							<?foreach ( $arEqip as $key => $asEq):?>
								<tr>
									<td><?=$asEq["equipment"]["name"]?></td>
									<?$itogo = 0;?>
									<?foreach ( $arOperationDate['debtor'] as $date => $arVal):?>
										<td align="center" width="70"><?=$arVal[$asEq["equipment_id"]]?></td>
										<?$itogo += $arVal[$asEq["equipment_id"]];?>
									<?endforeach;?>
									
									<td align="center" width="70"><?=$itogo?></td>
								</tr>	
							<?endforeach;?>
					</thead>
				</table>
				
				<br>
				<h4>Фактически на руках</h4>
				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">Наименование</th>
							<th>Итого</th>
						</tr>
						<tbody>
							<?foreach ( $arEqip as $key => $asEq):?>
								<tr>
									<td><?=$asEq["equipment"]["name"]?></td>
									<td align="center" width="70"><?=$asEq["count"]?></td>
								</tr>
							<?endforeach;?>
					</thead>
				</table>
				
				<?/*
				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">Дата</th>
							<th>Тип операции</th>
							<th>Наименование</th>
							<th class="text-xs-center">Кол-во</th> 
							<th>Менеджер</th>
						</tr>
					</thead>
					<tbody>
						<?foreach ( $arOperations as $key => $asOperation):?>
							<tr>
								<td><?=date("d.m.Y H:i",strtotime($asOperation['operation_date']))?></td>
								<td>
									<?
									switch ( $asOperation['operation_type'] ) {
										case 'lease':
											echo "выдано";
											break;
										case 'delete':
											echo "Удалено из заказа";
											break;
										case "debtor":
											echo "Возвращено";
											break;
									}
									?>
									
								</td>
								<td><?=$asOperation["equipment"]["name"]?></td>
								<td><?=$asOperation["count"]?></td>
								<td></td>
							</tr>
						<?endforeach;?>
					</tbody>
				</table>
				*/?>
			<?endif;?>
			

		</div>
	</div>

	<? \yii\bootstrap\Modal::begin(['id'=>'ModalForm'])?>
	<? \yii\bootstrap\Modal::end()?>
