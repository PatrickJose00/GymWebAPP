<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/custom.css',
        'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
        '//fonts.googleapis.com/css?family=Open+Sans'
    ];
    public $js = [
        'js/mapa/locationpicker.jquery.min.js',
        '//maps.google.com/maps/api/js?key=AIzaSyBdnH21MExv5GxMeNGeXs1fP0YterCINQA&sensor=false&libraries=places',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
