<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 9:07 PM
 */

namespace app\components;

use app\models\Group;
use yii\db\Query;
use yii\web\User;
use app\models\User as UserModel;
use Yii;


class WebUser extends User{

    public function setFlash($key, $message){
        if(!empty($key) && !empty($message)){
            Yii::$app->getSession()->setFlash($key, $message);
        }
    }

    public function isAdmin(){
        if($this->isGuest){
            return false;
        }

        return $this->checkAccess(Group::GROUP_ADMIN);
    }

    public function isModerator(){
        if($this->isGuest){
            return false;
        }

        return $this->checkAccess(Group::GROUP_MODELRATOR);
    }

    public function checkAccess($group){
        $command = new Query();
        /**
         * @var $command Query
         */
        $command->select('u.id')
            ->from('user u')
            ->join('LEFT JOIN', 'group_member gm', 'id_user = :user')
            ->join('LEFT JOIN', 'group g', 'g.id = gm.id_group')
            ->where('g.name = :group')
            ->params([
                ':user' => Yii::$app->user->getId(),
                ':group' => $group
            ]);

        $result = $command->one();

        return !empty($result);
    }

    public function afterLogin($identity, $cookieBased, $duration)
    {
        parent::afterLogin($identity, $cookieBased, $duration);

        $userModel = UserModel::findOne($this->getId());

        /**
         * @var $userModel UserModel
         */
        $now = new \DateTime();
        $userModel->last_login_date = $now->format('Y-m-d H:i:s');
        $userModel->last_login_ip = Yii::$app->request->getUserIP();
        $userModel->save();
    }

}