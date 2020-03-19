<?php
use panix\engine\Html;

//if (Yii::$app->user->isGuest) {
//    echo Html::a('', ['/users/register'], $this->context->linkOptions);
//} else {

    if ($this->context->isAdded) {
        echo Html::a('', ['/wishlist/default/remove', 'id' => $this->context->pk], $this->context->linkOptions);
    } else {
        echo Html::a('', ['/wishlist/default/add', 'id' => $this->context->pk], $this->context->linkOptions);
    }
//}

