<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/17/2016
 * Time: 1:35 AM
 *
 * @var $this yii\web\View
 * @var $userModel app\models\User
 * @var $group integer
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'edit-user-form',
    'options' => [
        'class' => 'ajax form-horizontal',
    ],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
        'labelOptions' => [
            'class' => 'col-lg-2 control-label'
        ]
    ]
]);

Yii::info(\yii\helpers\VarDumper::dumpAsString($userModel->getGroupMembers()));
?>
<h1>Редактиране на потребител</h1>

<?= $form->field($userModel, 'username') ?>
<?= $form->field($userModel, 'email')->input('email') ?>
<div class="form-group">
    <?= Html::label('Парола', 'password', [
        'class' => 'col-lg-2 control-label'
    ]) ?>
    <div class="col-lg-5">
        <?= Html::input('password', 'password', null, [
            'class' => 'form-control'
        ]) ?>
    </div>
</div>
<div class="form-group">
    <?= Html::label('Група', 'group', [
        'class' => 'col-lg-2 control-label'
    ]) ?>
    <div class="col-lg-5">
        <?= Html::dropDownList('group', $group, \app\models\Group::getGroupsArray(), [
            'prompt' => 'select',
            'class' => 'form-control'
        ]) ?>
    </div>
</div>

<div class="form-actions">
    <?= Html::input('submit', 'submit', 'Редактирай', [
        'class' => 'btn btn-confirm'
    ]) ?>
    <?= Html::button('Отказ', [
        'class' => 'btn btn-cancel close-dialog'
    ]) ?>
</div>

<?php ActiveForm::end(); ?>