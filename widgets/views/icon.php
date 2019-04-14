<?php
use panix\engine\Html;
if (!$this->context->isAdded) {
    if (Yii::$app->user->isGuest) {
        echo Html::a(Html::icon('icon-heart'), array('/users/register'), $this->context->linkOptions);
    } else {
        echo Html::a(Html::icon('icon-heart'), 'javascript:wishlist.add(' . $this->context->pk . ');', $this->context->linkOptions);
    }
}
