<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/animate.css',
        'css/icomoon.css',
        'css/magnific-popup.css',
        'https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800',
        'https://fonts.googleapis.com/css?family=Open+Sans:800',
        'css/owl.carousel.min.css',
//        'css/owl.theme.default.min.css',
        'css/style.css',
        'css/custom.css',
        'css/profile.css',
        'css/slider/slide.css',
        'css/slider/slick.css',
        'css/slider/slick-theme.css',
        'css/colorbox/colorbox.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
    ];
    public $js = [
        'js/modernizr-2.6.2.min.js',
//        'js/jquery.min.js',
        'js/jquery.easing.1.3.js',
        'js/jquery.waypoints.min.js',
        'js/jquery.stellar.min.js',
        'js/owl.carousel.min.js',
        'js/jquery.countTo.js',
//        'js/jquery.magnific-popup.min.js',
//        'js/magnific-popup-options.js',
        'js/main.js',
        'js/slick.min.js',
        'js/jquery.colorbox-min.js',
        '//maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false',
        'js/google_map.js',
        'js/mapa/locationpicker.jquery.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
