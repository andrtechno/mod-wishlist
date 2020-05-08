<?php

namespace panix\mod\wishlist;

use panix\mod\wishlist\models\WishList;
use Yii;
use panix\engine\WebModule;
use panix\mod\wishlist\components\WishListComponent;
use panix\mod\wishlist\models\WishListProducts;
use yii\base\BootstrapInterface;
use yii\caching\DbDependency;

/**
 * Class Module
 *
 * @property int $count
 * @package panix\mod\wishlist
 */
class Module extends WebModule implements BootstrapInterface
{
    private $_user_id;
    public $count = 0;
    private $_model;
    private $_ids;
    private $cacheDuration = 3600 * 24;

    public function bootstrap($app)
    {
        if (Yii::$app->id != 'console') {
            $app->urlManager->addRules(
                [
                    'wishlist' => 'wishlist/default/index',
                    'wishlist/add/<id:\d+>' => 'wishlist/default/add',
                    'wishlist/remove/<id:\d+>' => 'wishlist/default/remove',
                    'wishlist/view/<key:[0-9a-zA-Z]+>' => 'wishlist/default/view',
                ],
                false
            );
            $this->_user_id = Yii::$app->user->id;

            $app->setComponents([
                'wishlist' => ['class' => 'panix\mod\wishlist\components\WishListComponent'],
            ]);


            if ($this->_model === null) {
                // $model = WishList::findOne(['user_id'=>$this->getUserId()]);
                $model = WishList::find()
                    ->where(['user_id' => $this->getUserId()])
                    //->cache($this->cacheDuration)
                    ->one();
                if ($model === null) {
                    $model = new WishList;
                    $model->creater($this->getUserId());
                }
                $this->_model = $model;


                $table = WishListProducts::tableName();
                $dependency = new DbDependency(['sql' => "SELECT COUNT(*) FROM {$table} WHERE wishlist_id=" . $this->getModel()->id]);


                $this->_ids = Yii::$app->db->createCommand("SELECT product_id FROM {$table} WHERE wishlist_id=:id")
                    ->bindValue(':id', $this->getModel()->id)
                    //->cache($this->cacheDuration, $dependency)
                    ->queryColumn();
            }




            /*$this->count = (new WishListComponent)->count();*/
        }
    }

    public function getUserId()
    {
        return $this->_user_id;
    }

    public function getModel()
    {
        return $this->_model;
    }

    public function getIds()
    {
        if (Yii::$app->user->isGuest) {
            $session = Yii::$app->session;
            if (isset($session['wishlist_products'])) {
                return array_unique($session['wishlist_products']);
            }
        } else {
            return $this->_ids;
        }
        return [];

    }

}
