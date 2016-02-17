<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/15/2016
 * Time: 11:48 PM
 *
 * @var $this yii\web\View
 * @var $success boolean
 */

use yii\helpers\Html;
use app\components\FlashMessagesWidget;

$this->title = 'Забравена парлоа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forgot-container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?= FlashMessagesWidget::widget([
                'type' => [
                    'error',
                    'success'
                ],
                'default' => [
                    'type' => 'info',
                    'message' => '<strong>Важно!</strong> За да възтановите вашата парола, моля въведете имейл адраса с кото се се регистрирали!'
                ]
            ]) ?>
    <?php
    echo Html::beginForm("", 'post', [
        'class' => 'form-horizontal'
    ]);
    ?>
    <div class="form-group <?= !empty($error)    ? 'has-error' : ''?>">
        <?= Html::label('Въведете имел адрес', 'email', [
            'class' => 'col-lg-3 control-label'
        ]) ?>
        <div class="col-lg-3">
            <?= Html::input('email', 'email', null, [
                'class' => 'form-control'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <p class="help-block help-block-error"><?= $error ?></p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-11">
            <?= Html::submitButton('Изпрати', [
                'class' => 'btn btn-confirm'
            ]) ?>
        </div>
    </div>
    <?php
    echo Html::endForm();

    ?>
        </div>
    </div>
</div>