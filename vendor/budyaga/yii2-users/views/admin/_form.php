<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\cropper\Widget;
use budyaga\users\models\User;
use yii\helpers\Url;
use app\models\Storage;

/* @var $this yii\web\View */
/* @var $model budyaga\users\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-6 col-md-8">
		<div class="card">
			<div class="card-header">
				<?= Html::encode($this->title) ?>
			</div>

				<div class="card-block">
					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

					<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

				
					<?= $form->field($model, 'status')->dropDownList(User::getStatusArray()); ?>

					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? Yii::t('users', 'CREATE') : Yii::t('users', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>

					
				</div>

		</div>
	</div>
	<div class="col-sm-6 col-md-4">
	

		<div class="card">
			<div class="card-header">
				Склады пользователя
			</div>
			<div class="card-block">
					<?foreach ( $arStorages as $key => $val ):?>
						<div class="checkbox">
							<label for="checkbox<?=$key?>">
								<input type="checkbox" id="checkbox<?=$key?>" name="storage[<?=$key?>]" value="<?=$key?>" <?if (in_array($key, $arUserStore)):?>checked<?endif;?>> <?=$val?>
							</label>
						</div>
					<?endforeach;?>
			</div>
		</div>	
	</div>	
</div>
				
<?php ActiveForm::end(); ?>