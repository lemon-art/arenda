<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use app\models\Storage;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<?php $this->beginBody() ?>

    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
            </li>

            <li class="nav-item px-1">
                <a class="nav-link" href="/user/admin/">Пользователи</a>
            </li>
			<li class="nav-item px-1">
                <a class="nav-link" href="/storage/">Склады</a>
            </li>
            <li class="nav-item px-1">
                <a class="nav-link" href="/user/rbac">Настройки</a>
            </li>
        </ul>

        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="hidden-md-down"><?=Yii::$app->user->identity->username;?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                   
                    <a class="dropdown-item" href="/profile"><i class="fa fa-user"></i>Профиль</a>
                    <a class="dropdown-item" href="/logout"><i class="fa fa-lock"></i> Выход</a>
                </div>
            </li>
            <li class="nav-item hidden-md-down">
                
            </li>

        </ul>
    </header>
	
	<div class="app-body">
		<div class="sidebar">
			
		
		
		
			<nav class="sidebar-nav">
				<?
				$menuItems = [
					['label' => 'Новый заказ', 'url' => ['/orders/create/'], 'icon' => ['fa fa-plus fa-lg m-t-2'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
					['label' => 'Заказы', 'options' => ['class' => 'nav-title'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Действующие', 'icon' => ['fa fa-play-circle fa-lg m-t-2'], 'url' => ['/orders/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Просроченые', 'icon' => ['fa fa-ban fa-lg m-t-2'], 'url' => ['/orders/expired/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Архив заказов', 'icon' => ['fa fa-trash fa-lg m-t-2'], 'url' => ['/orders/archive/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
					['label' => 'Оплаты', 'options' => ['class' => 'nav-title'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Добавить оплату', 'icon' => ['fa fa-plus-circle fa-lg m-t-2'], 'url' => ['/payment/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Список оплат', 'icon' => ['fa fa-rub fa-lg m-t-2'], 'url' => ['/payment/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
					['label' => 'Клиенты', 'options' => ['class' => 'nav-title'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Добавить клиента', 'icon' => ['fa fa-user-plus fa-lg m-t-2'], 'url' => ['/clients/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Физ. лица', 'icon' => ['fa fa-user fa-lg m-t-2'], 'url' => ['/clients/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
						['label' => 'Юр. лица', 'icon' => ['fa fa-user-secret fa-lg m-t-2'], 'url' => ['/clients/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
					['label' => 'Склады', 'url' => ['/storage/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link'], 'items' => Storage::GetStorageList()],
					['label' => 'Товары', 'url' => ['/equipment/'], 'options' => ['class' => 'nav-item'], 'linkOptions' => ['class' => 'nav-link']],
					
				];
				echo Nav::widget([
					'options' => ['class' => 'nav'],
					'items' => $menuItems,
				]);
				?>
				
					
			</nav>
	

                

        </div>

        <!-- Main content -->
        <main class="main">
		        <?= Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
				<?= Alert::widget() ?>
				<div class="container-fluid">
					<?= $content ?>
				</div>
		</main>
		    </div>

    <footer class="app-footer">
        <a href="">Аренда 2.0</a> © 2017
        <span class="float-right"></a>
        </span>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
