<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/15/2016
 * Time: 11:48 PM
 *
 * @var $this yii\web\View
 */

use yii\helpers\Html;


echo Html::beginForm("", 'post', [
    'class' => 'form-horizontal'
]);
?>
<div class="form-group <?= !empty($error)    ? 'has-error' : ''?>">
    <?= Html::label('Въведете имел адрес', 'email', [
        'class' => 'col-lg-2 control-label'
    ]) ?>
    <div class="col-lg-3">
        <?= Html::input('email', 'email', null, [
            'class' => 'form-control'
        ]) ?>
    </div>
    <div class="col-lg-7">
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
