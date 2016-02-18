<?php

/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 9:42 PM
 */


namespace app\filters;

use Yii;
use yii\filters\AccessRule;

class AccessRules extends AccessRule {
    protected function matchRole($user){
        if(empty($this->roles)){
            return true;
        }

        foreach ($this->roles as $role){
            if($role === 'admin' ) {
                if (Yii::$app->user->isAdmin()) {
                    return true;
                }
            } else if($role === 'moderator'){
                if(Yii::$app->user->isModerator()){
                    return true;
                }
            } else if($role === '?'){
                if(Yii::$app->user->isGuest){
                    return true;
                }
            } else if($role === '@'){
                if(!Yii::$app->user->isGuest){
                    return true;
                }
            }
        }
    }
}