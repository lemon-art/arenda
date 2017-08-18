<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Новый заказ';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];

?>
<div class="card">
    <div class="card-header"><?= Html::encode($this->title) ?></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
