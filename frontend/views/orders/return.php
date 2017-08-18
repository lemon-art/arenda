<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Возврат по заказу №' . $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Заказ №' . $model->order_id, 'url' => ['view', 'id' => $model->order_id]];
$this->params['breadcrumbs'][] = 'Возврат';
?>
<div class="card">
    <div class="card-header"><?= Html::encode($this->title) ?></div>


    <?= $this->render('_return_form', [
        'model' => $model,
		'arEqip' => $arEqip
    ]) ?>

</div>
