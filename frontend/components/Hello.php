<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 18.05.17
 * Time: 15:11
 */

namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;

class Hello extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run()
    {
        return Html::encode($this->message);
    }
}