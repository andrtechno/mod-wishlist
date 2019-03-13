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
                'wishlist/add/<id>' => 'wishlist/default/add',
                'wishlist/remove/<id>' => 'wishlist/default/remove',
                'wishlist/view/<key>' => 'wishlist/default/view',
            ],
            false
        );

        $app->setComponents([
            'wishlist' => ['class' => 'panix\mod\wishlist\components\WishlistComponent'],
        ]);
    }
}
