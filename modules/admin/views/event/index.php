<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 11:14 PM
 */

use yii\helpers\Html;

$this->title = 'Събития';
$this->params['breadcrumbs'][] = ['label' => 'Админ панел', 'url' => '/admin/default/index'];
$this->params['breadcrumbs'][] = $this->title;

echo Html::a('Нов', Yii::$app->urlManager->createUrl('admin/event/edit'), [
    'class' => 'btn btn-info'
]);

if(Yii::$app->user->checkAccess(\app\models\Group::GROUP_ADMIN)){
    echo Html::a('Сървъри', Yii::$app->urlManager->createUrl('admin/servers'), [
        'class' => 'btn btn-primary',
        'style' => 'margin-left: 20px'
    ]);
}
