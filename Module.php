<?php

class Module extends \panix\engine\WebModule {

    public $roles = [
        'wishlist' => 'wishlist/default/index',
        'wishlist/add/<id>' => 'wishlist/default/add',
        'wishlist/remove/<id>' => 'wishlist/default/remove',
        'wishlist/view/<key>' => 'wishlist/default/view',
    ];

    /**
     * инициализация модуля
     */
    public function init() {

        parent::init();
    }

}
