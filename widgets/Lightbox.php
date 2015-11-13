<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Lightbox extends Widget {

    public $url;

    public function init() {
        \app\assets\LightboxAsset::register($this->getView());
    }

    public function run() {
        return Html::a(
            Html::img($this->url, ['width' => '100px']),
            $this->url,
            ['data-lightbox' => 'image-' . uniqid()]
        );
    }

}