<?php

namespace panix\mod\wishlist\models;

class WishlistProducts extends \yii\db\ActiveRecord {



    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return '{{%wishlist_products}}';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'wishlist_id' => 'Wishlist',
            'product_id' => 'Product',
            'user_id' => 'User',
        );
    }

}
