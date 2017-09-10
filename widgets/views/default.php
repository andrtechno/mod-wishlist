<?php
     if (!$this->isAdded) {
if (Yii::app()->user->isGuest) {
    echo Html::link(Yii::t('WishlistModule.default', 'BTN_WISHLIST', 0), array('/users/register'), $this->linkOptions);
} else {
    echo Html::link(Yii::t('WishlistModule.default', 'BTN_WISHLIST', 1), 'javascript:wishlist.add(' . $this->pk . ');', $this->linkOptions);
}
     }else{
         echo 'already wishlist';
     }