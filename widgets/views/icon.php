<?php
use panix\engine\Html;

if (Yii::$app->user->isGuest) {
    echo Html::a(Html::icon('heart'), ['/users/register'], $this->context->linkOptions);
} else {
    echo Html::a(Html::icon('heart'), ['/wishlist/default/add/', 'id' => $this->context->pk], $this->context->linkOptions);
}

