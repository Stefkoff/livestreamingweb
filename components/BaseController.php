<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/18/2016
 * Time: 11:54 PM
 */

namespace app\components;

use yii\web\Controller;
use Yii;
use yii\helpers\VarDumper;

class BaseController extends Controller {
    protected function log($data){
        Yii::info(VarDumper::dumpAsString($data));
    }
}