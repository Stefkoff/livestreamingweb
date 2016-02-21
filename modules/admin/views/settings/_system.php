<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/21/2016
 * Time: 1:56 PM
 *
 * @var $settings array
 */

use yii\helpers\Html;

?>
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
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Панел Събития</h5>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label>
                            <?= Html::checkbox('show_panel_events', empty($settings['show_panel_events']) ? false : $settings['show_panel_events'], [
                                'uncheck' => '0',
                                'label' => 'Покажи панел със събития'
                            ]) ?>
                        </label>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="alert alert-info">
                        <strong>Панелът със събития</strong> показва кратък път към  <strong>предстоящите</strong> събитиятя, подредени по хронологиче ред
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Спиране на регистрация</h5>
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
                            <?= Html::checkbox('stop_registrations', empty($settings['stop_registrations']) ? false : $settings['stop_registrations'], [
                                'uncheck' => '0',
                                'label' => 'Изключване на регистрация за нови потребители'
                            ]) ?>
                        </label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="alert alert-danger">
                        <strong>Внимание! </strong> Нови потребители няма да могат да се регистрират в системата!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
