<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
	<?php Pjax::begin(['id' => 'dataTable']) ?>   
	<div class="col-sm-6 col-md-4">
        <div class="card">
			
				<div class="card-header">
					Категории товаров
					
					<div class="tools pull-right">
						<?=Html::a('<span class="glyphicon glyphicon-plus"></span>', '/equipment/createcategory?equipment_id='.$_GET['equipment_id'], [
											'id' => 'activity-view-link',
											'title' => 'Добавить категорию', 
											'data-toggle' => 'modal',
											'data-target' => '#ModalForm',
											'data-id' => $key,
											'data-type' => 'post',
											'data-remote' => ['createcategory'],
											'data-equipment_id' => $_GET['equipment_id']

										]); 
									?>
									
						<?=Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/equipment/updatecategory?equipment_id='.$_GET['equipment_id'], [
											'id' => 'activity-view-link',
											'title' => 'Редактировать категорию', 
											'data-toggle' => 'modal',
											'data-target' => '#ModalForm',
											'data-id' => $_GET['equipment_id'],
											'data-type' => 'post'
										]); 
									?>	

						<?=Html::a('<span class="glyphicon glyphicon-trash"></span>', '/equipment/createcategory?equipment_id='.$_GET['equipment_id'], [
											'id' => 'activity-view-link',
											'title' => 'Добавить категорию', 
											'data-toggle' => 'modal',
											'data-target' => '#ModalForm',
											'data-id' => $key,
											'data-type' => 'post',
											'data-remote' => ['createcategory'],
											'data-equipment_id' => $_GET['equipment_id']

										]); 
									?>										
									
					</div>
				</div>
			
				<ul class="category tree">
					<?$curLevel = 0;?> 
					<?foreach( $arSections as $key => $arSection):?>
						<?if ( ($arSection["level"] == $curLevel) && $key>0 ):?></li><?endif;?>
						<?if ( $arSection["level"] > $curLevel):?><ul><?endif;?>
						<?if ( $arSection["level"] < $curLevel):?></ul><?endif;?>		
						<li <?if ( $arSection['equipment_id']==$_GET['equipment_id']):?>class="expanded"<?endif;?>>
							<?=Html::a( $arSection['name'], '?equipment_id='.$arSection['equipment_id'], ['tabindex' => '0', 'class' => ($arSection['equipment_id']==$_GET['equipment_id']) ? 'tree-item-active' : 'no']); ?>
								
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
							'arenda',
							'price',

							[
							'class' => 'yii\grid\ActionColumn',
							'template' => '{update} {delete}',
							'buttons' => [
								'update' => function ($url, $model, $key) {
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
					    <p>
						<?= Html::a('Create Equipment', ['create'], ['class' => 'btn btn-success']) ?>
					</p>
				
			  
            </div>
			
        </div>
    </div>
<?php Pjax::end(); ?>

	
	<? \yii\bootstrap\Modal::begin(['id'=>'ModalForm'])?>
	<? \yii\bootstrap\Modal::end()?>