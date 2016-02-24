<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/25/2016
 * Time: 12:13 AM
 *
 * @var $this \app\components\View
 * @var $eventModel \app\models\Event
 * @var $servers array
 */

use yii\bootstrap\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'event-from'
]);

echo $form->field($eventModel, 'name');
echo $form->field($eventModel, 'description')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
//    'language' => 'en',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste image"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);

echo $form->field($eventModel, 'datetime')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => 'Enter event time ...'],
    'pluginOptions' => [
        'autoclose' => true,
    ]
]);

echo $form->field($eventModel, 'place');
?>
<div class="form-group field-event-place required">
    <label class="control-label" for="event-id_server">Сървър</label>
    <?php
    echo Html::activeDropDownList($eventModel, 'id_server', $servers, [
        'class' => 'form-control'
    ]);
    ?>
</div>

<div class="form-actions">
    <?= Html::submitButton('Запази', [
        'class' => 'btn btn-primary'
    ]) ?>
</div>

<?php ActiveForm::end(); ?>