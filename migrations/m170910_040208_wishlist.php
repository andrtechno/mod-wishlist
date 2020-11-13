<?php

namespace panix\mod\wishlist\migrations;

use Yii;
use panix\engine\db\Migration;
use panix\mod\wishlist\models\WishList;
use panix\mod\wishlist\models\WishListProducts;

/**
 * Class m170910_040208_wishlist
 */
class m170910_040208_wishlist extends Migration
{

    public function up()
    {
        $this->createTable(WishList::tableName(), [
            'id' => $this->primaryKey(),
            'key' => $this->string(10)->defaultValue(''),
            'user_id' => $this->integer(),
        ], $this->tableOptions);


        $this->createTable(WishListProducts::tableName(), [
            'id' => $this->primaryKey(),
            'wishlist_id' => $this->integer(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
        ], $this->tableOptions);


        $this->createIndex('user_id', WishList::tableName(), 'user_id');
        $this->createIndex('key', WishList::tableName(), 'key');


        $this->createIndex('wishlist_id', WishListProducts::tableName(), 'wishlist_id');
        $this->createIndex('product_id', WishListProducts::tableName(), 'product_id');
        $this->createIndex('user_id', WishListProducts::tableName(), 'user_id');

        $userModel = Yii::$app->user->identityClass;
        $this->addForeignKey('{{%fk_wishlist_user_id}}', WishList::tableName(), 'user_id', $userModel::tableName(), 'id');

    }

    public function down()
    {
        $this->dropTable(WishList::tableName());
        $this->dropTable(WishListProducts::tableName());
    }

}
