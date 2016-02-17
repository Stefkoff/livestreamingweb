<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 10:42 PM
 *
 * @var $this yii\web\View
 */

use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'Потребители';
$this->params['breadcrumbs'][] = ['label' => 'Админ панел', 'url' => '/admin/default/index'];
$this->params['breadcrumbs'][] = $this->title;


$dataProvide = new ActiveDataProvider([
    'query' => \app\models\User::find(),
    'pagination' => [
        'pageSize' => 20
    ]
]);

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvide,
    'columns' => [
        'username',
        'email',
        'creation_date',
        'last_login_date',
        'last_login_ip',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
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

<script type="text/javascript">
    $(function(){
        $(document).controls();
    });
</script>
