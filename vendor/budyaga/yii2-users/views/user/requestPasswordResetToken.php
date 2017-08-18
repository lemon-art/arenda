<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('users', 'REQUEST_PASSWORD_RESET');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth">
   


            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
				<h1><?= Html::encode($this->title) ?></h1>
                <?= $form->field($model, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('users', 'SEND'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>

</div>
