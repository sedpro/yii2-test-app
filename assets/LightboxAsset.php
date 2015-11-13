<?php

namespace app\assets;

use yii\web\AssetBundle;

class LightboxAsset extends AssetBundle {

    public $sourcePath = '@bower/lightbox2';

    public $js = [
        'src/js/lightbox.js',
    ];

    public $css = [
        'src/css/lightbox.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

