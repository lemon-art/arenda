<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

		<?=$form->field($model, 'data')->widget(DatePicker::className(), [
			'language' => 'ru',
			'dateFormat' => 'dd.MM.yyyy',
		]) ?> 

	<?= $form->field($model, 'order_id')->hiddenInput(['value' => $order_id])->label(false);?>
	<?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false);?>

    <?= $form->field($model, 'summ')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList([ 'nal' => 'Nal', 'beznal' => 'Beznal', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
