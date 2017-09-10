<?php

if (!$this->isAdded) {
    if (Yii::app()->user->isGuest) {
        echo Html::link(Html::tag('i', array('class' => 'icon-heart'), '', true), array('/users/register'), $this->linkOptions);
    } else {
        echo Html::link(Html::tag('i', array('class' => 'icon-heart'), '', true), 'javascript:wishlist.add(' . $this->pk . ');', $this->linkOptions);
    }
}
