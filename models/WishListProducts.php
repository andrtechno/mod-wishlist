<?php

namespace panix\mod\wishlist\models;

use yii\db\ActiveRecord;

/**
 * Class WishListProducts
 * @property integer $id
 * @property integer $wishlist_id
 * @property integer $product_id
 * @property integer $user_id
 * @package panix\mod\wishlist\models
 */
class WishListProducts extends ActiveRecord
{


    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%wishlist_products}}';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'wishlist_id' => 'WishList',
            'product_id' => 'Product',
            'user_id' => 'User',
        );
    }

}
