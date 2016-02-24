<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/24/2016
 * Time: 11:35 PM
 */

namespace app\components;


use yii\grid\ActionColumn;
use Yii;
use yii\helpers\Html;

class CustomColumn extends ActionColumn {
    public function initDefaultButtons()
    {
        if (!isset($this->buttons['edit'])) {
            $this->buttons['edit'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                    'class' => 'open-dialog'
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'class' => 'open-dialog',
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
            };
        }
    }
}