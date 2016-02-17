<?php

namespace app\modules\admin;

use Yii;

class Admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();

        $this->layoutPath = Yii::getAlias('@app/modules/admin/views/layouts');
        $this->layout = 'admin';
    }
}
