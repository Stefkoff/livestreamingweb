<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 10:40 PM
 */

namespace app\modules\admin\controllers;

use app\filters\AccessRules;
use yii\filters\AccessControl;
use app\components\BaseController;
use Yii;

class BaseAdminController extends BaseController{


    protected $roles;

    public function init() {
        $this->roles = [
            'admin'
        ];
    }

    public function addRoles($roles){
        if(is_array($roles)){
            $this->roles = array_merge($this->roles, $roles);
        }
    }

    public function behaviors()
    {
        $this->init();
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRules::className()
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->roles
                    ]
                ]
            ]
        ];
    }
}