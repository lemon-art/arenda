<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
?>

			
            <div class="card-header">
                 <i class="fa fa-align-justify"></i><?= $title; ?>
            </div>
			<div class="card-block">	
				
					<?= GridView::widget([
							'dataProvider' => $dataProvider,
							'columns' => [
								['class' => 'yii\grid\SerialColumn'],

								
								[
									'label' => 'Наименование',
									'format' => 'raw',
									'contentOptions'   =>   ['class' => 'product_name'], 
									'value' => function($data)  {
										return $data->name;
									}
								],
								
								[
									'label' => 'Доступно',
									'format' => 'raw',
									'contentOptions'   =>   ['class' => 'product_count'], 
									'value' => function($data) use ($arConsist) {
										return Html::tag(
											'span', 
											$arConsist[$data->equipment_id]['presence']
										);
									}
								],
								
								[
									'label' => 'Цена',
									'format' => 'raw',
									'contentOptions'   =>   ['class' => 'product_price'], 
									'value' => function($data)  {
										return $data->price;
									}
								],

								[
								'class' => 'yii\grid\CheckboxColumn'
								],
							],
						]); ?>
			</div>
				
<script>
		
		
		$('.select-on-check-all').change(function() {
			if(this.checked) {
				$('.table-striped input[type="checkbox"]').prop("checked", "checked");
			}
			else {
				$('.table-striped input[type="checkbox"]').prop("checked", "");
			}
		});
		
		
		
	</script>
		  
	
