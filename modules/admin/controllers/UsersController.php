<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 10:38 PM
 */

namespace app\modules\admin\controllers;

use app\models\Group;
use app\models\GroupMember;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;

class UsersController extends BaseAdminController {

    public function actionIndex(){

        $dataProvider = new ActiveDataProvider([
            'query' => \app\models\User::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionNew(){
        $userModel = new User();

        if($userModel->load(Yii::$app->request->post())){
            $userModel->setScenario('insert');
            if($userModel->save()){
                echo "<a class='auto-close success' href='" . Yii::$app->urlManager->createUrl('admin/users/index') . "'></a>";
            }
        }

        return $this->renderPartial('_new', [
            'userModel' => $userModel
        ]);
    }

    public function actionEdit(){
        $request = Yii::$app->request;

        $id = $request->get('id', false);

        if($id){
            $userModel = User::findOne($id);

            /**
             * @var $userModel User
             */

            if($userModel){

                $submitButton = $request->post('submit', false);

                if($submitButton){
                    if($userModel->load($request->post()) && $userModel->validate()){
                        $password = $request->post('password', false);

                        if($password){
                            $userModel->password = $password;
                            $userModel->setScenario('updatePassword');
                        }
                        if($userModel->save()){
                            $group = $request->post('group', false);

                            if($group){
                                $groupModel = Group::findOne($group);

                                /**
                                 * @var $groupModel Group
                                 */

                                if($groupModel){
                                    $groupMember = GroupMember::findOne([
                                        'id_user' => $userModel->id,
                                    ]);

                                    /**
                                     * @var $groupMember GroupMember
                                     */

                                    if($groupMember){
                                        $groupMember->id_group = $group;
                                        $groupMember->save();
                                    } else{
                                        $groupMember = new GroupMember();
                                        $groupMember->id_user = $userModel->id;
                                        $groupMember->id_group = $groupModel->id;

                                        $groupMember->save();
                                    }
                                }
                            }
                            echo "<a class='auto-close success' href='" . Yii::$app->urlManager->createUrl('admin/users/index') . "'></a>";
                        }
                    }
                }

                $userInGroup = $userModel->getGroupMembers()->one();
                /**
                 * @var $userInGroup GroupMember
                 */

                $groupId = null;

                if($userInGroup){
                    $group = $userInGroup->getGroup()->one();
                    $groupId = $group->id;
                }
                return $this->renderPartial('_edit', [
                    'userModel' => $userModel,
                    'group' => $groupId
                ]);
            }
        }


        return $this->renderAjax('_edit');
    }

    public function actionDelete(){
        $request = Yii::$app->request;

        $id = $request->get('id', false);

        if($id){
            $userModel = User::findOne($id);

            /**
             * @var $userModel User
             */

            if($userModel){
                $confirmButton = $request->post('submit', false);

                if($confirmButton){
                    $userModel->delete();
                    echo "<a class='auto-close success' href='" . Yii::$app->urlManager->createUrl('admin/users/index') . "'></a>";
                }

                return $this->renderPartial('_delete', [
                    'userModel' => $userModel
                ]);
            }
        }
    }

}