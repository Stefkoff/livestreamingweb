<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/17/2016
 * Time: 7:33 PM
 *
 * @var $this yii\web\View
 * @var $userModel app\models\User
 */
?>
<h1>Добавяне на потребител</h1>
<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'new-user-form',
    'options' => [
        'class' => 'ajax form-horizontal'
    ],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
        'labelOptions' => [
            'class' => 'col-lg-2 control-label'
        ]
    ]
]);
?>

<?= $form->field($userModel, 'username') ?>
<?= $form->field($userModel, 'password')->passwordInput() ?>
<?= $form->field($userModel, 'email')->input('email') ?>


<div class="form-actions">
    <?= Html::submitButton('Добави', [
        'class' => 'btn btn-success'
    ]) ?>
    <?= Html::button('Отказ', [
        'class' => 'btn btn-danger close-dialog'
    ]) ?>
</div>
<?php
ActiveForm::end();
?>