<?php

namespace panix\mod\wishlist\widgets;

use Yii;
use panix\engine\data\Widget;
use panix\mod\wishlist\components\WishListComponent;
use yii\base\InvalidArgumentException;

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
 *  'linkOptions' => ['class' => 'btn btn-compare']
 * ]);
 * </code>
 *
 */
class WishListWidget extends Widget
{

    public $pk;
    public $linkOptions = [];
    public $isAdded = false;

    public function init()
    {
        if (is_null($this->pk))
            throw new InvalidArgumentException(Yii::t('wishlist/default', 'ERROR_PK_ISNULL'));

        parent::init();
    }

    public function run()
    {

        $wishListComponent = new WishListComponent();
        $this->isAdded = (in_array($this->pk, $wishListComponent->getIds())) ? true : false;
        $this->linkOptions['data-pjax'] = 0;
        if ($this->isAdded) {
            $this->linkOptions['title'] = Yii::t('wishlist/default', 'ALREADY_EXIST');
            $this->linkOptions['class'] .= ' added';
        }

        return $this->render($this->skin, []);
    }

}
