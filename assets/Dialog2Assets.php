<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/24/2016
 * Time: 11:10 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class Dialog2Assets extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $css = [
        'css/jquery.dialog2.css'
    ];

    public $js = [
        'js/jquery.forms.js',
        'js/jquery.controls.js',
        'js/jquery.dialog2.js',
        'js/jquery.dialog2.helpers.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}