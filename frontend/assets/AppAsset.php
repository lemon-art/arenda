<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/font-awesome.min.css',
		'css/simple-line-icons.css',
		'css/style.css'
    ];
    public $js = [
		'js/jQuery.tree.js',
		'js/tether.min.js',
		'js/main.js',
		'js/app.js',
		'js/Chart.min.js',
		'js/pace.min.js',
		'js/views/main.js',
		'js/widgets.js'
		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
