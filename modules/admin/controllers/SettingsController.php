<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/19/2016
 * Time: 7:44 PM
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\Setting;

class SettingsController extends BaseAdminController {
    public function actionIndex(){
        $request = Yii::$app->request;

        if($request->post('submit', false)){
            Yii::$app->user->setFlash('success', 'Настройките са записани <strong>усепешно!</strong>');
            Setting::saveMultiple($request->post());
        }

        $settings = Setting::getAll();

        return $this->render('index', [
            'settings' => $settings
        ]);
    }
}