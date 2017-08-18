<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	
	<div class="card">
        <div class="card-header">
            Действующие заказы
        </div>
        <div class="card-block">
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			//'filterModel' => $searchModel,
			'tableOptions' => [
				'class' => 'table table-hover table-outline m-b-0 hidden-sm-down'
			],
			'columns' => [
				[
					'attribute' => 'order_id',
					'format' => 'raw',
					'value' => function($model){
						return Html::a($model->order_id,['view', 'id' => $model->order_id]);
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
		
	
</div>
