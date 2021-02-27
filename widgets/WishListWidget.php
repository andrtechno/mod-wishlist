<?php

namespace panix\mod\wishlist\widgets;

use panix\mod\wishlist\models\WishList;
use panix\mod\wishlist\WishListAsset;
use Yii;
use panix\engine\data\Widget;
use panix\engine\Html;
use panix\mod\wishlist\components\WishListComponent;
use yii\base\InvalidArgumentException;
use yii\web\View;

/**
 * Widget add to wishlist module for shop.
 *
 * @version 1.0
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 * @link http://pixelion.com.ua PIXELION CMS
 *
 * Example:
 * <code>
 * echo \panix\mod\wishlist\widgets\WishListWidget::widget([
 *  'pk' => $model->primaryKey,
 *  'skin' => 'icon',
 *  'linkOptions' => ['class' => 'btn btn-wishlist']
 * ]);
 * </code>
 *
 */
class WishListWidget extends Widget
{

    /**
     * @var \yii\db\ActiveRecord
     */
    public $model;
    public $linkOptions = [];
    public $addText = '';
    public $removeText = '';
    public $isAdded = false;

    private $routeRemove = '/wishlist/default/remove';
    private $routeAdd = '/wishlist/default/add';

    public function init()
    {
        if (is_null($this->model))
            throw new InvalidArgumentException(Yii::t('wishlist/default', 'ERROR_PK_ISNULL'));

        parent::init();
    }

    public function run()
    {

        /*$this->view->registerJs("
        var wishlist_add_text = '{$this->addText}';
        var wishlist_remove_text = '{$this->removeText}';
        ", View::POS_END, 'wishlist_js2');*/


        $refrect = new \ReflectionClass($this->model);

        $asset = WishListAsset::register($this->view);
        $ids = Yii::$app->getModule('wishlist')->getIds();

        $this->isAdded = (in_array($this->model->getPrimaryKey(), $ids)) ? true : false;
        $this->linkOptions['data-pjax'] = 0;
        $this->linkOptions['class'] .= ' wishlist-' . mb_strtolower($refrect->getShortName()) . '-' . $this->model->getPrimaryKey();
        if ($this->isAdded) {
            $this->linkOptions['title'] = Yii::t('wishlist/default', 'ALREADY_EXIST');
            $this->linkOptions['class'] .= ' added';
        }
        $this->linkOptions['data-id'] = $this->model->getPrimaryKey();
        //if (!empty($this->removeText) && !empty($this->addText)) {
        //    $this->linkOptions['data-text'] = ($this->isAdded) ? $this->removeText : $this->addText;
       // }

        $this->linkOptions['data-text-remove'] = $this->removeText;
        $this->linkOptions['data-text-add'] = $this->addText;
        return Html::a(($this->isAdded) ? $this->removeText : $this->addText, ['/wishlist/default/' . (($this->isAdded) ? 'remove' : 'add'), 'id' => $this->model->getPrimaryKey()], $this->linkOptions);

    }


}
