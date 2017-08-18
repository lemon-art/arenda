<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Carousel;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить клиента', ['create'], ['class' => 'btn btn-success', 'data-toggle' => 'modal',
							'data-target' => '#ModalForm', 'title' => 'Добавить клиента']); ?>
    </p>
<?php Pjax::begin(); ?>    


 <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'firstname',
				'format' => 'raw',
				'value' => function($model){
					return Html::a($model->firstname,['view', 'id' => $model->person_id]);
				},
			],
            'name',
            'lastname',
            'phone',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
				'buttons' => [
					'update' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url, [
							'id' => 'activity-view-link',
							'title' => 'Редактировать клиента',
							'data-toggle' => 'modal',
							'data-target' => '#ModalForm',
							'data-id' => $key,
							'data-pjax' => '0',
							'data-remote' => $url

						]);
					},
				],
				],
			],
    ]); ?>

<?php Pjax::end(); ?>

	<? \yii\bootstrap\Modal::begin(['id'=>'ModalForm'])?>
	<? \yii\bootstrap\Modal::end()?>
	
</div>