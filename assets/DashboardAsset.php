<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/22/2016
 * Time: 4:08 PM
 */

namespace app\assets;

use yii\web\AssetBundle;


class DashboardAsset extends AssetBundle {
    public $sourcePath = '@app/modules/admin/assets/';
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    public $css = [
        'css/admindashboard.css'
    ];

    public $js = [
        'js/admindashboard.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}