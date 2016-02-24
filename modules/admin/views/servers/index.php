<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/24/2016
 * Time: 11:06 PM
 *
 * @var $this \app\components\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\helpers\Html;

$this->title = 'Сървъри';
$this->params['breadcrumbs'][] = ['label' => 'Админ панел', 'url' => '/admin/default/index'];
$this->params['breadcrumbs'][] = ['label' => 'Събития', 'url' => '/admin/event'];
$this->params['breadcrumbs'][] = $this->title;

echo Html::a('Нов', Yii::$app->urlManager->createUrl('admin/servers/edit'), [
    'class' => 'btn btn-primary open-dialog'
]);
echo "<br>";
echo "<br>";

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'host',
        'port',
        [
            'class' => 'app\components\CustomColumn',
            'template' => '{edit} {delete}',
            'options' => [
                'style' => 'width: 60px'
            ]
        ],
    ]]);