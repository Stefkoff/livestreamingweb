<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/20/2016
 * Time: 1:20 AM
 */

namespace app\commands;

use app\models\Setting;
use yii\console\Controller;

class MaintenanceController extends Controller{
    public function actionUp(){
        Setting::set('maintenance', '1');
        echo "Maintenance mode ACTIVATED\n";
    }

    public function actionDown(){
        Setting::set('maintenance', '0');
        echo "Maintenance mode DEACTIVATED\n";
    }

}