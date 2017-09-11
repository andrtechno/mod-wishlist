<?php

namespace panix\mod\wishlist\assets;

class WishlistAsset extends \yii\web\AssetBundle {

       public $sourcePath = __DIR__;
    /*  public $jsOptions = array(
      'position' => \yii\web\View::POS_HEAD
      );
 */

    public $js = [
        'js/wishlist.js',
    ];
   /* public $depends = [
        'panix\mod\cart\assets\CartAsset'
    ];*/

}
