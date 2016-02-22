<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/22/2016
 * Time: 9:49 PM
 */

namespace app\assets;

use yii\web\AssetBundle;


class SocketAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $js = [
        'js/socket.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}