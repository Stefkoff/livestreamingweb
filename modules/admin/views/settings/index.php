<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/19/2016
 * Time: 7:46 PM
 *
 * @var $settings array
 */

use yii\helpers\Html;

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = ['label' => 'Админ панел', 'url' => '/admin/default/index'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
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
                    <div class="row">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h5>Режим потдръжка</h5>
                                    </div>
                                    <div class="col-lg-4">
                                        <span class="label label-danger pull-right">Danger</span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkbox">
                                            <label>
                                                <?= Html::checkbox('maintenance', empty($settings['maintenance']) ? false : $settings['maintenance'], [
                                                    'uncheck' => '0',
                                                    'label' => 'Превключване на системата в режим <strong>Потдръжка</strong>'
                                                ]) ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="alert alert-danger">
                                            <strong>Внимание! </strong> Изключването на тази опция е ръчно!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h5>Нотификации</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label>
                                                <?= Html::checkbox('notifications', empty($settings['notifications']) ? false : $settings['notifications'], [
                                                    'uncheck' => '0',
                                                    'label' => 'Нотификации'
                                                ]) ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="alert alert-info">
                                            <strong>Нотификациите</strong> се използват за събшаване в реално време за стартирало събитие
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="users">
                    Потребители
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
