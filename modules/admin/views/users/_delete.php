<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/17/2016
 * Time: 6:37 PM
 *
 * @var $this yii\web\View
 * @var $userModel app\models\User
 */

use yii\helpers\Html;

echo Html::beginForm('', 'post', [
    'class' => 'ajax',
    'id' => 'delete-user-form'
])
?>

<h1>Изтриване на потребител</h1>

<?= "Потвърдете изтриването на потребител <strong>" . $userModel->username . '</strong>' ?>

<div class="form-actions">
    <?= Html::input('submit', 'submit', 'Изтриване', [
    'class' => 'btn btn-confirm'
]) ?>
    <?= Html::button('Отказ', [
    'class' => 'btn btn-cancel close-dialog'
]) ?>
</div>

<?= Html::endForm() ?>