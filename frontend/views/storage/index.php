<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Carousel;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Склады';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-index">

    <h1><?= Html::encode($this->title) ?></h1>
	
    <p>
        <?= Html::a('Добавить склад', ['create'], ['class' => 'btn btn-success', 'data-toggle' => 'modal',
							'data-target' => '#ModalForm', 'title' => 'Добавить склад']); ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
				'buttons' => [
					'update' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url, [
							'id' => 'activity-view-link',
							'title' => 'Редактировать склад',
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
	
	<? \yii\bootstrap\Modal::begin(['id'=>'ModalForm'])?>
	<? \yii\bootstrap\Modal::end()?>
	

</div>
