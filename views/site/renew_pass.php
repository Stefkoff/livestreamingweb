<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 7:42 PM
 *
 * @var $this yii\web\View
 * @var $accessToken string
 */

use yii\helpers\Html;
use app\components\FlashMessagesWidget;
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?= FlashMessagesWidget::widget([
            'type' => [
                'error',
                'success'
            ],
            'default' => [
                'type' => 'info',
                'message' => "<strong>Важно!</strong> Моля, попълнете полетата!"
            ]
        ]) ?>
        <?= Html::beginForm('', 'post', [
            'class' => 'form-horizontal'
        ]) ?>

        <div class="form-group">
            <?= Html::label('Нова парола', 'new_pass', [
                'class' => 'col-lg-3 control-label'
            ]) ?>
            <div class="col-lg-3">
                <?= Html::input('password', 'new_pass', null, [
                    'class' => 'form-control'
                ]) ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::label('Повторете паролата', 're_pass', [
                'class' => 'col-lg-3 control-label'
            ]) ?>
            <div class="col-lg-3">
                <?= Html::input('password', 're_pass', null, [
                    'class' => 'form-control'
                ]) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-11">
                <?= Html::submitButton('Изпрати', [
                    'class' => 'btn btn-confirm',
                    'name' => 'submit',
                    'value' => 1
                ]) ?>
            </div>
        </div>
        <?= Html::hiddenInput('token', $accessToken) ?>
        <?= Html::endForm() ?>
    </div>
</div>
