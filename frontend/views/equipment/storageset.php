<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Equipment */
?>


<?php \yii\widgets\Pjax::begin(); ?> 

	<div class="row">
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
							<?=Html::a( $arSection['name'], '/equipment/storagesetcat?id=1&equipment_id='.$arSection['equipment_id'], ['tabindex' => '0', 'data-pjax' => '0', 'class' => ($arSection['equipment_id']==$_GET['equipment_id']) ? 'tree-item-active' : 'no']); ?>
								
						<?$curLevel = $arSection["level"];?>
					<?endforeach;?>
					</li>
				</ul>
			
        </div>
    </div>

				<div class="col-lg-8">
        <div class="card" id="eq">
			
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
</p>
				
			  
            </div>
			
        </div>
		</div>
				
	</div>			

<?php \yii\widgets\Pjax::end(); ?>
<?= Html::submitButton('Доавить к заказу', ['class' => 'btn btn-success', 'id' => 'add_to_order']) ?>
	
	<script>
		$('.category').tree({
			expanded: 'li.expanded'
		});
		$('.tree li a').click(function(){

			$.get( $(this).attr('href'), function(data){
				$('#eq').html(data);
			});
			return false;
		});
		
		$('#add_to_order').click(function(){

			n = $('#products').find('tbody').find('tr').length;
			$('.table-striped input:checkbox:checked').each(function(){
				n = n*1 + 1;
				var product_name = $(this).parent().parent().find('.product_name').text();
				var product_count = $(this).parent().parent().find('.product_count').text();
				var product_price = $(this).parent().parent().find('.product_price').text();
				var product_input = '<input class="product_count" type="number" min="0" max="' + product_count + '" size="3" name="eq['+ $(this).val() +']" value="1">';
				$('#products').find('tbody').append([
					'<tr>',
						'<td>'+n+'</td>',
						'<td>'+product_name+'</td>',
						'<td class="product_count">'+product_count+'</td>',
						'<td class="product_price">'+product_price+'</td>',
						'<td>'+product_input+'</td>',
						'<td class="total_count">'+product_price+'</td>',
						'<td><span class="glyphicon glyphicon-remove delete-tr"></span></td>',
					'</tr>'
				].join(''));
				
			});
			refresh_order();
			$("#SelectModalForm").modal('hide');
			$("#products_div").show();
			return false;
		});
		
		function refresh_order(){
			summ = 0;
			$('table#products_old tbody tr').each(function(){
				summ += parseInt( $(this).find(".total_count").text() );
			});
			
			$('table#products tbody tr').each(function(){
				summ += parseInt( $(this).find(".total_count").text() );
			});
			$('#itog_day').show().find('span').text( summ );
			
			if ( $('#arenda_days').find('span').text()){
				all = summ * parseInt( $('#arenda_days').find('span').text() );
				$('#itog_all').show().find('span').text( all );
				$('#orders-summ').val( all );
			}
			
			return false;
		}
		
		
		$('.select-on-check-all').change(function() {
			if(this.checked) {
				$('.table-striped input[type="checkbox"]').prop("checked", "checked");
			}
			else {
				$('.table-striped input[type="checkbox"]').prop("checked", "");
			}
		});
		
		
		
	</script>		  
	
