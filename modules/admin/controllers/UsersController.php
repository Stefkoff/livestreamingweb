<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 10:38 PM
 */

namespace app\modules\admin\controllers;


class UsersController extends BaseAdminController {

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionEdit(){
        return $this->renderAjax('_edit');
    }

}