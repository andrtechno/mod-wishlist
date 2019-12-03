<?php

namespace panix\mod\wishlist;

use panix\engine\WebModule;
use yii\base\BootstrapInterface;

class Module extends WebModule implements BootstrapInterface {

    public function bootstrap($app)
    {
        $app->urlManager->addRules(
            [
                'wishlist' => 'wishlist/default/index',
                'wishlist/add/<id:\d+>' => 'wishlist/default/add',
                'wishlist/remove/<id:\d+>' => 'wishlist/default/remove',
                'wishlist/view/<key>' => 'wishlist/default/view',
            ],
            false
        );

        $app->setComponents([
            'wishlist' => ['class' => 'panix\mod\wishlist\components\WishListComponent'],
        ]);
    }
}
