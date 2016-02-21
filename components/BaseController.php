<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/18/2016
 * Time: 11:54 PM
 */

namespace app\components;

use app\models\Setting;
use yii\web\Controller;
use Yii;
use yii\helpers\VarDumper;

class BaseController extends Controller {

    public function beforeAction($action)
    {
        // default handling of parent before action
        if(!parent::beforeAction($action)) {
            return false;
        }

        // Retrieving of maintenance setting from DB
        // (of course, you can use smth. other)
        $onMaintenance = intval(Setting::get('maintenance', false));

        // It the module have to be in maintenance mode according to our settings
        if($onMaintenance) {
            // and currently requested action is not our maintenance action
            // this is used to avoid infinite call loop
            if($action->id != 'maintenance')
                // we redirect users to maintenance page
                \Yii::$app->response->redirect(['site/maintenance']);
            else
                // and we allow an action to be executed if it is our maintenance action
                return true;
        }

        return true;
    }

    protected function log($data){
        Yii::info(VarDumper::dumpAsString($data));
    }

    protected function sendJson($data){
        echo json_encode($data);
        Yii::$app->end();
    }
}