<?php
/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/17/2016
 * Time: 7:45 PM
 */

namespace app\components;

use yii\base\Component;
use Yii;

class Time extends Component {
    public function getUTCNow($format = 'Y-m-d H:i:s'){
        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone('UTC'));
        return $now->format($format);
    }

    public function getLocalNow($format = 'Y-m-d H:i:s'){
        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone('Europe/Sofia'));
        return $now->format($format);
    }

    public function toLocal($datetime){
        $now = new \DateTime($datetime);
        $now->setTimezone(new \DateTimeZone('Europe/Sofia'));
        return $now->format('Y-m-d H:i:s');
    }
}