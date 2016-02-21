<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/21/2016
 * Time: 2:01 PM
 *
 * @var $this app\components\View
 * @var $settings array
 */

use yii\helpers\Html;
?>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Имейл за потвърждение на регистрация</h5>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="checkbox">
                        <label>
                            <?= Html::checkbox('send_confirmation_email', empty($settings['send_confirmation_email']) ? false : $settings['send_confirmation_email'], [
                                'uncheck' => '0',
                                'label' => 'Изпрати имейл за потвърдение'
                            ]) ?>
                        </label>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="alert alert-info">
                        <strong>Имейл за потвърждение</strong> се изпраща на новорегистрираните потребители, за да потвърдят регистрацията си!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
