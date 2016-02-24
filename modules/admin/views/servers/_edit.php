<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/24/2016
 * Time: 11:21 PM
 *
 * @var $this \app\components\View
 * @var $serverModel \app\models\Server
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'servers-form',
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

/**
 * @var $form ActiveForm
 */

if(!$serverModel->id){
    echo "<h1>Добавяне на сървър</h1>";
} else{
    echo "<h1>Редактиране на сървър</h1>";
}

echo $form->field($serverModel, 'host');
echo $form->field($serverModel, 'port');
?>

<div class="form-actions">
    <?= Html::submitButton('Запиши', [
        'class' => 'btn btn-primary'
    ]) ?>
    <?= Html::button('Отказ', [
        'class' => 'btn btn-cancel close-dialog'
    ]) ?>
</div>

<?php ActiveForm::end(); ?>