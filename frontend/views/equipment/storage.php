<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
$title = 'Склад - ' . $storeName;

$this->title = $title;
//$this->params['breadcrumbs'][] = ['label' => 'Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $title;
?>
<div class="equipment-view">

    <h1><?= Html::encode($title) ?></h1>
	<br>
<?php Pjax::begin(['id' => 'dataTable']) ?>   
	<div class="col-sm-6 col-md-4">
        <div class="card">
			
				<div class="card-header">
					Категории товаров
					
				</div>
			
				<ul class="category tree">
					<?$curLevel = 0;?> 
					<?foreach( $arSections as $key => $arSection):?>
						<?if ( ($arSection["level"] == $curLevel) && $key>0 ):?></li><?endif;?>
						<?if ( $arSection["level"] > $curLevel):?><ul><?endif;?>
						<?if ( $arSection["level"] < $curLevel):?></ul><?endif;?>		
						<li <?if ( $arSection['equipment_id']==$_GET['equipment_id']):?>class="expanded"<?endif;?>>
							<?=Html::a( $arSection['name'], '?id=' . $storeID . '&equipment_id='.$arSection['equipment_id'], ['tabindex' => '0', 'class' => ($arSection['equipment_id']==$_GET['equipment_id']) ? 'tree-item-active' : 'no']); ?>
								
						<?$curLevel = $arSection["level"];?>
					<?endforeach;?>
					</li>
				</ul>
			
        </div>
    </div>

	
	<div class="col-lg-8">
        <div class="card">
			
            <div class="card-header">
                 <i class="fa fa-align-justify"></i><?= $title; ?>
            </div>
			<div class="card-block">
			
			
				<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],

							
							'name',
							[
								'label' => 'Всего',
								'format' => 'raw',
								'value' => function($data) use ($arConsist) {
									return Html::tag(
										'span', 
										$arConsist[$data->equipment_id]['total']
									);
								}
							],
							[
								'label' => 'На руках',
								'format' => 'raw',
								'value' => function($data) use ($arConsist) {
									return Html::tag(
										'span', 
										$arConsist[$data->equipment_id]['leased']
									);
								}
							],
							[
								'label' => 'В наличии',
								'format' => 'raw',
								'value' => function($data) use ($arConsist) {
									return Html::tag(
										'span', 
										$arConsist[$data->equipment_id]['presence']
									);
								}
							],

							[
							'class' => 'yii\grid\ActionColumn',
							'template' => '{update2}',
							'buttons' => [
								'update2' => function ($url, $model, $key) use ($storeID) {
								
									$url = 'storage_edit/?storage_id='.$storeID . '&equipment_id=' . $key . '&section=' . $_GET['equipment_id'];
									
									return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url, [
										'id' => 'activity-view-link',
										'title' => 'Редактировать товар',
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

				
			  
            </div>
			
        </div>
    </div>
<?php Pjax::end(); ?>

	
	<? \yii\bootstrap\Modal::begin(['id'=>'ModalForm'])?>
	<? \yii\bootstrap\Modal::end()?>
	
</div>