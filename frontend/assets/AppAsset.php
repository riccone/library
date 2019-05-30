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
        //'css/site.css',
        //'css/bootstrap.min.css',
        'css/plugins.css',
        'css/style.css',
        'css/custom.css',
    ];

    public $js = [
        'js/vendor/jquery-3.2.1.min.js',
        'js/popper.min.js',
        //'js/bootstrap.min.js',
        'js/plugins.js',
        'js/active.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        '\rmrevin\yii\fontawesome\AssetBundle',
        'grozzzny\depends\bootstrap4\Bootstrap4Asset',
        'grozzzny\depends\bootstrap4\Bootstrap4PluginAsset',
    ];
}
