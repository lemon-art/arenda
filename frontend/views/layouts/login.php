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
<body class="">
	<?php $this->beginBody() ?>

	<?= Alert::widget() ?>

	<?= $content ?>
	
	
	
<?php $this->endBody() ?>
<script>
			function verticalAlignMiddle()
			{
				var bodyHeight = $(window).height();
				var formHeight = $('.vamiddle').height();
				var marginTop = (bodyHeight / 2) - (formHeight / 2);
				if (marginTop > 0)
				{
					$('.vamiddle').css('margin-top', marginTop);
				}
			}
			$(document).ready(function()
			{
				verticalAlignMiddle();
			});
			$(window).bind('resize', verticalAlignMiddle);
        </script>
</body>
</html>
<?php $this->endPage() ?>