<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model budyaga\users\models\User */

$this->title = Yii::t('users', 'UPDATE_USER', ['username' => $model->username]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('users', 'USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>


				
				<?= $this->render('_form', [
					'model' => $model,
					'title' => $this->title,
					'arStorages' => $arStorages,
					'arUserStore' => $arUserStore
				]) ?>
		