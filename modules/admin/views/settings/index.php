<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/19/2016
 * Time: 7:46 PM
 *
 * @var $settings array
 * @var $this app\components\View
 */

use yii\helpers\Html;
use app\components\FlashMessagesWidget;

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = ['label' => 'Админ панел', 'url' => '/admin/default/index'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <?= FlashMessagesWidget::widget([
        'type' => [
            'success'
        ]
    ]) ?>
    <?= Html::beginForm() ?>
    <div class="row">
        <h3>Меню</h3>
        <div class="tabbable">
            <ul class="nav nav-pills nav-stacked col-md-2">
                <li class="active">
                    <a href="#system" data-toggle="tab">Система</a>
                </li>
                <li>
                    <a href="#users" data-toggle="tab">Потребители</a>
                </li>
            </ul>
            <div class="tab-content col-md-10">
                <div class="tab-pane active" id="system">
                    <h4>Системни насторйки</h4>
                    <hr>
                    <?= $this->render('_system', array(
                            'settings' => $settings
                        )); ?>

                </div>
                <div class="tab-pane" id="users">
                    <h4>Потребителски настройки</h4>
                    <hr>
                    <?= $this->render('_users', [
                        'settings' => $settings
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1 col-lg-offset-11">
            <input type="submit" name="submit" value="Запиши" class="btn btn-primary"/>
        </div>
    </div>
    <?= Html::endForm() ?>
</div>
