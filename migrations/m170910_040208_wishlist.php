<?php

use yii\db\Migration;

/**
 * Class m170910_040208_wishlist
 */
class m170910_040208_wishlist extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%wishlist}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(10)->defaultValue(''),
            'user_id' => $this->integer(),
                ], $tableOptions);


        $this->createTable('{{%wishlist_products}}', [
            'id' => $this->primaryKey(),
            'wishlist_id' => $this->integer(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
                ], $tableOptions);


        $this->createIndex('user_id', '{{%wishlist}}', 'user_id');
        $this->createIndex('key', '{{%wishlist}}', 'key');


        $this->createIndex('wishlist_id', '{{%wishlist_products}}', 'wishlist_id');
        $this->createIndex('product_id', '{{%wishlist_products}}', 'product_id');
        $this->createIndex('user_id', '{{%wishlist_products}}', 'user_id');
    }

    public function down() {
        $this->dropTable('{{%wishlist}}');
        $this->dropTable('{{%wishlist_products}}');
    }

}
