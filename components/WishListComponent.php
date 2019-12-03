<?php

namespace panix\mod\wishlist\components;

use Yii;
use panix\mod\shop\models\Product;
use panix\mod\wishlist\models\WishList;
use yii\base\Component;

class WishListComponent extends Component {

    /**
     * Максимальное количество товаров могут быть добавлены к списку желаний
     */
    const MAX_PRODUCTS = 50;

    /**
     * @var array if products id
     */
    private $_products;

    /**
     * @var WishList
     */
    private $_model;

    /**
     * @var null
     */
    private $_user_id;

    /**
     * @param mixed $user_id
     */
    public function __construct($user_id = null) {
        if ($user_id)
            $this->_user_id = $user_id;
        else
            $this->_user_id = Yii::$app->user->id;

        parent::__construct([]);
    }

    /**
     * Check if product exists add to list
     * 
     * <code>
     * $wish = new WishListComponent;
     * $wish->add(5);
     * </code>
     * 
     * @param string $id product id
     * @return boolean
     */
    public function add($id) {
        if ($this->count() <= self::MAX_PRODUCTS && Product::find()->where(['id' => $id])->published()->count() > 0) {
            $current = $this->getIds();
            $current[(int) $id] = (int) $id;
            $this->setIds($current);
            return true;
        }
        return false;
    }

    /**
     * Уделание товаров из списка
     * 
     * <code>
     * $wish = new WishListComponent;
     * $wish->remove(5);
     * </code>
     * 
     * @param int $id
     */
    public function remove($id) {
        $current = $this->getIds();

        $pos = array_search($id, $current);
        if (isset($current[$pos]))
            unset($current[$pos]);
        $this->setIds($current);
    }

    /**
     * 
     * Пример кода:
     * <code>
     * $wish = new WishListComponent;
     * $wish->getIds(); //Вернет массив
     * </code>
     * 
     * @return array of product id added to wishlist
     */
    public function getIds() {
        $model = $this->getModel();

        if ($model)
            return $model->getIds();

        return array();
    }

    /**
     * Массовое добавление товаров
     * 
     * Пример кода:
     * <code>
     * $wish = new WishListComponent;
     * $wish->setIds(array(4,1));
     * </code>
     * 
     * @param array $ids
     */
    public function setIds(array $ids) {
        $ids = array_unique($ids);
        $this->getModel()->setIds($ids);
    }

    /**
     * Очистить список
     */
    public function clear() {
        $this->setIds([]);
    }

    /**
     * Get and/or create user wishlist
     * @return WishList
     */
    public function getModel() {
        if ($this->_model === null) {
            $model = WishList::findOne(['user_id'=>$this->getUserId()]);
           // $model = WishList::find(['user_id' => $this->getUserId()])->one();
            if ($model === null){
                $model = new WishList;
                $model->creater($this->getUserId());
            }
            $this->_model = $model;
        }
        return $this->_model;
    }

    /**
     * @return array of Product models to wish list
     */
    public function getProducts() {

        if ($this->_products === null){
            $this->_products = Product::findAll(['id'=>array_values($this->getIds())]);
        }
        return $this->_products;
    }

    /**
     * Get current user id
     * @return mixed
     */
    public function getUserId() {
        return $this->_user_id;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return Yii::$app->urlManager->createAbsoluteUrl(['/wishlist/default/view', 'key' => $this->getModel()->key]);
    }

    /**
     * @param $key
     * @return null|WishList
     * @throws \Exception
     */
    public function loadByKey($key) {
       // $model = WishList::find(['key' => $key])->one();
        $model = WishList::findOne(['key' => $key]);

        if ($model === null)
            throw new \Exception();
        $this->_model = $model;
        $this->_user_id = $model->user_id;
        return $model;
    }

    /**
     * Количество товаров добавленых в список желаний
     * 
     * Пример кода:
     * <code>
     * $wish = new WishListComponent;
     * $wish->count(); //Вернет количество
     * </code>
     * 
     * @return int
     */
    public function count() {
        return sizeof($this->getIds());
    }

}
