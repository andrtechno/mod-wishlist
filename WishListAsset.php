<?php

namespace panix\mod\wishlist;

use panix\engine\web\AssetBundle;

class WishListAsset extends AssetBundle
{

    public $sourcePath = __DIR__.'/assets';

    public $js = [
        'js/wishlist.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
