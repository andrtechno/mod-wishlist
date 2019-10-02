<?php

namespace panix\mod\wishlist\migrations;

use panix\engine\db\Migration;
use panix\mod\wishlist\models\Wishlist;
use panix\mod\wishlist\models\WishlistProducts;

/**
 * Class m170910_040208_wishlist
 */
class m170910_040208_wishlist extends Migration
{

    public function up()
    {
        $this->createTable(Wishlist::tableName(), [
            'id' => $this->primaryKey(),
            'key' => $this->string(10)->defaultValue(''),
            'user_id' => $this->integer(),
        ], $this->tableOptions);


        $this->createTable(WishlistProducts::tableName(), [
            'id' => $this->primaryKey(),
            'wishlist_id' => $this->integer(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
        ], $this->tableOptions);


        $this->createIndex('user_id', Wishlist::tableName(), 'user_id');
        $this->createIndex('key', Wishlist::tableName(), 'key');


        $this->createIndex('wishlist_id', WishlistProducts::tableName(), 'wishlist_id');
        $this->createIndex('product_id', WishlistProducts::tableName(), 'product_id');
        $this->createIndex('user_id', WishlistProducts::tableName(), 'user_id');
    }

    public function down()
    {
        $this->dropTable(Wishlist::tableName());
        $this->dropTable(WishlistProducts::tableName());
    }

}
