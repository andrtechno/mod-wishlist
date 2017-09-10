<?php

namespace panix\mod\wishlist;

class Module extends \panix\engine\WebModule {

    public $routes = [
        'wishlist' => 'wishlist/default/index',
        'wishlist/add/<id>' => 'wishlist/default/add',
        'wishlist/remove/<id>' => 'wishlist/default/remove',
        'wishlist/view/<key>' => 'wishlist/default/view',
    ];

    public function init() {

        parent::init();
    }

}
