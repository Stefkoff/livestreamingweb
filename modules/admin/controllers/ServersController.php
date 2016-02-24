<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/24/2016
 * Time: 11:04 PM
 */

namespace app\modules\admin\controllers;

use app\models\Server;
use Yii;
use yii\data\ActiveDataProvider;


class ServersController extends BaseAdminController {

    public function actionIndex(){

        $dataProvider = new ActiveDataProvider([
            'query' => Server::find(),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionEdit(){
        $request = Yii::$app->request;

        if($request->isAjax){

            $serverModel = null;
            $id = $request->get('id', false);

            $this->log($id);

            if($id){
                $serverModel = Server::findOne($id);
            } else{
                $serverModel = new Server();
            }

            if($serverModel->load($request->post()) && $serverModel->validate()){
                $serverModel->save();
                echo "<a class='auto-close success reload'></a>";
                Yii::$app->end();
            } else{
                $this->log($serverModel->errors);
            }

            return $this->renderPartial('_edit', [
                'serverModel' => $serverModel
            ]);

        }
    }

}