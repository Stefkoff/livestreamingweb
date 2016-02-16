<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/15/2016
 * Time: 10:25 PM
 *
 * @var $form \app\models\RegisterForm;
 *
 * @var $this yii\web\View;
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please iff out the following fields to register:</p>

    <?php
    $activeForm = ActiveForm::begin([
        'id' => 'register-form',
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => [
                'class' => 'col-lg-2 control-label'
            ]
        ]
    ]);

    echo $activeForm->field($form, 'username');
    echo $activeForm->field($form, 'password')->passwordInput();
    echo $activeForm->field($form, 'repPass')->passwordInput();
    echo $activeForm->field($form, 'email')->input('email');
//    echo Html::activeCheckbox($form, 'loginAfter');
    ?>
    <div class="form-actions">
    <?php
    echo Html::submitButton('Register', [
        'class' => 'btn btn-confirm'
    ]);

    ActiveForm::end();
    ?>
    </div>
</div>
