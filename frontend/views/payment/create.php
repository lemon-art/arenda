<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'Оплата по заказу ' . $order_id;
?>

    <?= $this->render('_form', [
        'model' => $model,
		'order_id' => $order_id
    ]) ?>


