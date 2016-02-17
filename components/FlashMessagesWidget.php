<?php

/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/16/2016
 * Time: 8:17 PM
 */

namespace app\components;

use Yii;
use yii\base\Widget;

class FlashMessagesWidget extends Widget{

    /**
     * @var $type - error, succes, etc. OR ALL
     */
    public $type;

    /**
     *
     * If no Flashes -> show default one
     *
     * @var $default array
     */
    public $default;

    protected $messages;

    public function init()
    {
        parent::init();

        $this->messages = Yii::$app->getSession()->getAllFlashes(true);

        Yii::info($this->messages);

    }

    public function run()
    {
        if(empty($this->messages)){
            if(!empty($this->default)) {
                return "<div class='alert alert-" . (isset($this->default['type']) ? $this->default['type'] : 'info') . "'>" . $this->default['message'] . "</div>";
            }
        }

        $html = '';
        foreach($this->messages as $key => $value){
            if($this->type === 'all' || (is_array($this->type) && in_array($key, $this->type)) || (!is_array($this->type) && $key === $this->type)){
                $html .= "<div class='alert alert-" . $key . "'>" .(in_array($key, ['error', 'danger']) ? "<strong>Грешка!</strong> " : '' ) .  $value . "</div>";
            }
        }

        return $html;
    }

}