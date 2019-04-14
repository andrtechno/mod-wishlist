<?php
use panix\engine\Html;
if (!$this->context->isAdded) {
    if (Yii::$app->user->isGuest) {
        echo Html::a(Yii::t('wishlist/default', 'BTN_WISHLIST', 0), ['/users/register'], $this->context->linkOptions);
    } else {
        echo Html::a(Yii::t('wishlist/default', 'BTN_WISHLIST', 1), 'javascript:wishlist.add(' . $this->context->pk . ');', $this->context->linkOptions);
    }
} else {
    echo 'already wishlist';
}