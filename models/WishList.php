<?php

namespace panix\mod\wishlist\models;

use Yii;
use panix\mod\wishlist\models\WishListProducts;
use panix\engine\db\ActiveRecord;

class WishList extends ActiveRecord {


    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return '{{%wishlist}}';
    }

    /**
     * @param $user_id
     */
    public function creater($user_id) {
        $model = new WishList;
        $model->user_id = $user_id;
        $model->key = $this->createSecretKey();
        $model->save(false);
        return;
    }

    /**
     * @param array $ids
     */
    public function setIds(array $ids) {
        WishListProducts::deleteAll(['wishlist_id' => $this->id]);

        if (!empty($ids)) {

            foreach ($ids as $id) {
                $record = new WishListProducts;
                $record->wishlist_id = $this->id;
                $record->product_id = $id;
                $record->user_id = $this->user_id;
                $record->save(false);
            }
        }
    }

    public function afterDelete() {
        $this->setIds(array());
        parent::afterDelete();
    }

    /**
     * get products ids save in the current wishlist
     */
    public function getIds() {
            $table = WishListProducts::tableName();
                return Yii::$app->db->createCommand("SELECT product_id FROM {$table} WHERE wishlist_id=:id")
                ->bindValue(':id', $this->id)
                ->queryColumn();
                        
        /*return Yii::$app->db->createCommand()
                        ->select('product_id')
                        ->from(WishListProducts::tableName())
                        ->where('wishlist_id=:id', array(':id' => $this->id))
                        ->queryColumn();*/
    }

    /**
     * Create unique key to view orders
     * @param int $size
     * @return string
     */
    public function createSecretKey($size = 10) {
        $result = '';
        $chars = '1234567890qweasdzxcrtyfghvbnuioplkjnm';
        while (mb_strlen($result, 'utf8') < $size)
            $result .= mb_substr($chars, rand(0, mb_strlen($chars, 'utf8')), 1);

        if (WishList::find()->where(['key' => $result])->count() > 0)
            $this->createSecretKey($size);

        return $result;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'key' => 'Key',
            'user_id' => 'User',
        );
    }

    /**
     * @param null $user_id if null will count for current user
     * @return mixed
     */
    public static function countByUser($user_id = null) {
        if ($user_id === null)
            $user_id = Yii::$app->user->id;
        $table = WishListProducts::tableName();
        return Yii::$app->db->createCommand("SELECT COUNT(id) FROM {$table} WHERE user_id=:user_id")->bindValue(':user_id', $user_id)->queryScalar();
    }

}