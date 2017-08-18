<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->person_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->person_id], [
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
								<label class="control-label">ФИО:</label> <?=$model->fullName?>
					</div>
					<div class="form-group">
						<label class="control-label">Телефон:</label> <?=$model->phone?>
					</div>
					<div class="form-group">
						<label class="control-label">Адрес:</label> <?=$model->address?>
					</div>
					<?if ( $model->add_phone ):?>
						<div class="form-group">
							<label class="control-label">Доп. телефон:</label> <?=$model->add_phone?>
						</div>
					<?endif;?>
					<?if ( $model->dop_text ):?>
						<div class="form-group">
							<label class="control-label">Примечание:</label> <?=$model->dop_text?>
						</div>
					<?endif;?>
				</div>
				<div class="form-group col-sm-6">
					<div class="card">
                        <div class="card-header">
                            Паспортные данные
                        </div>
                        <div class="card-block">
							<div class="form-group">
								<label class="control-label">Номер:</label> <?=$model->document_number?>
							</div>
							<div class="form-group">
								<label class="control-label">Выдан:</label> <?=$model->issued_from?>
							</div>
							<div class="form-group">
								<label class="control-label">Дата выдачи:</label> <?=date("d.m.Y",strtotime($model->issued_date))?>
							</div>
							<?if ( $model->birthday ):?>
								<div class="form-group">
									<label class="control-label">Дата рождения:</label> <?=$model->birthday?>
								</div>
							<?endif;?>
						</div>
					</div>
		</div>
	</div>


	<div class="card">
        <div class="card-header">
            Заказы клиента
		</div>
        <div class="card-block">
		<?= GridView::widget([
			'dataProvider' => $ordersProvider,
			//'filterModel' => $searchModel,
			'tableOptions' => [
				'class' => 'table table-hover table-outline m-b-0 hidden-sm-down'
			],
			'columns' => [
				[
					'attribute' => 'order_id',
					'format' => 'raw',
					'value' => function($model){
						return Html::a($model->order_id,['orders/view', 'id' => $model->order_id]);
					},
	 
				],
				//'data_update',
				'data_start',
				'data_finish',
				 [
					'attribute' => 'storage_id',
					'value' => 'storage.name' 
				 ],  
				 [
					'attribute' => 'clients',
					'value' => 'clients.fullName' 
				 ], 
				 
				 /*[
					'label' => 'Ссылка',
					'format' => 'raw',
					'value' => function($data){
						$proc = $data -> GetProgressData( $data -> data_start, $data -> data_finish);
					
						return Html::tag(
							'progress', 
							'50%', 
							[
								'class' => 'progress progress-xs progress-warning m-a-0',
								'value' => $proc,
								'max'	=> '100'
							]
						);
					}
				],*/
				'summ',
				[
					'attribute' => '',
					'format' => 'raw',
					'value' => function($model){
						if ( strtotime($model ->data_finish) <  strtotime(date("Y-m-d"))){
							return Html::tag('span', '', ['class' => 'avatar-status tag-danger']);
						}
						else {
							return Html::tag('span', '', ['class' => 'avatar-status tag-success']);
						}
					},
				 ], 
			],
		]); ?>
		</div>
	</div>
	
	
	<?if ( count ( $arPayments )> 0):?>
				<br><br>
				<h3>Оплаты клиента</h3>
				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">Дата</th>
							<th>Номер заказа</th>
							<th>Сумма</th>
							<th>Способ оплаты</th> 
							<th>Менеджер</th>
						</tr>
					</thead>
					<tbody>
						<?foreach ( $arPayments as $key => $asOperation):?>
							<tr>
								<td><?=date("d.m.Y",strtotime($asOperation['data']))?></td>
								<td><?=$asOperation["order_id"]?></td>
								<td><?=$asOperation["summ"]?></td>
								<td>
									<?
									switch ( $asOperation['type'] ) {
										case 'nal':
											echo "ниличные";
											break;
										case 'beznal':
											echo "безнал";
											break;
									}
									?>
									
								</td>
								<td></td>
							</tr>
						<?endforeach;?>
					</tbody>
				</table>
			<?endif;?>
	
	
	<?if ( count ( $arOperations )> 0):?>
				<br><br>
				<h3>Операции клиента</h3>
				<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="products">
					<thead class="thead-default">
						<tr>
							<th class="text-xs-center">Дата</th>
							<th>Номер заказа</th>
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
								<td><?=$asOperation["order_id"]?></td>
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
			<?endif;?>
	
	


</div>
