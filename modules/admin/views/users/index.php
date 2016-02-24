<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 10:42 PM
 *
 * @var $this yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use yii\helpers\Html;

$this->title = 'Потребители';
$this->params['breadcrumbs'][] = ['label' => 'Админ панел', 'url' => '/admin/default/index'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="users" >
        <?= Html::a('Нов', Yii::$app->urlManager->createUrl('admin/users/new'), [
            'class' => 'btn btn-info open-dialog',
            'id' => 'new-user'
        ]) ?>
    <br>
    <br>
    <?php

    echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'username',
            'email',
            [
                'header' => 'Дата на регистриране',
                'value' => function($data){
                    return Yii::$app->time->toLocal($data->creation_date);
                }
            ],
            [
                'header' => 'Последно влизане',
                'value' => function($data){
                    if(!empty($data->last_login_date)){
                        return Yii::$app->time->toLocal($data->last_login_date);
                    } else{
                        return 'Все още не е влизъл';
                    }
                }
            ],
            'last_login_ip',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{edit} {delete}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'class' => 'open-dialog'
                        ];
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'class' => 'open-dialog',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                    }
                ],
            ],
        ]]);

    ?>
</div>
<script type="text/javascript">
    $(function(){

    });
</script>
