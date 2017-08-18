<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use budyaga\users\components\AuthChoice;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\forms\LoginForm */

$this->title = Yii::t('users', 'LOGIN');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth">
    

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
				<h1><?= Html::encode($this->title) ?></h1>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    <?= Yii::t('users', 'YOU_CAN_RESET_PASSWORD', ['url' => Url::toRoute('/user/user/request-password-reset')])?>
					<p><a href="/signup">Регистрация</a></p>
				</div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('users', 'LOGIN'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>

</div>
