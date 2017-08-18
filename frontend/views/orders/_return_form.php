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
		
		<?= $form->field($model, 'data_start')->hiddenInput()->label(false);?>
		<?= $form->field($model, 'data_finish')->hiddenInput()->label(false);?>
		<?= $form->field($model, 'person_id')->hiddenInput()->label(false);?>
		<?= $form->field($model, 'storage_id')->hiddenInput()->label(false);?>

		<h3>Товары в заказе</h3>
		
		<table class="table table-hover table-outline m-b-0 hidden-sm-down" id="">
            <thead class="thead-default">
                <tr>
                    <th class="text-xs-center">№</th>
                    <th>Наименование</th>
                    <th>У клиента</th>
                    <th class="text-xs-center">Возврат</th> 
                </tr>
            </thead>
			<tbody>
				<?$daySumm = 0; $allSumm = 0;?>
				<?foreach ( $arEqip as $key => $asEq):?>
					<?if ( $asEq["count"] > 0 ):?>
						<tr>
							<td><?=$key+1?></td>
							<td><?=$asEq["equipment"]["name"]?></td>
							<td  class="product_price"><?=$asEq["count"]?></td>
							<td><input class="product_count" type="number" min="0" max="<?=$asEq["count"]?>" size="3" name="eq[<?=$asEq["equipment_id"]?>]" value="<?=$asEq["count"]?>"></td>
						</tr>
					<?endif;?>
				<?endforeach;?>
			</tbody>
		</table>

		
		
		<div class="form-group"> 
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Вернуть на склад', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
		

		

		<?php ActiveForm::end(); ?>
	</div>



