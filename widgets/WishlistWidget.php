<?php


class WishlistWidget extends yii\base\Widget {

    public $registerFile = array('wishlist.js');
    public $pk;
    public $linkOptions = array();
    public $isAdded = false;

    public function init() {

        Yii::import('mod.wishlist.WishlistModule');
        if (is_null($this->pk))
            throw new CException(Yii::t('WishlistWidget.default', 'ERROR_PK_ISNULL'));

        $this->assetsPath = dirname(__FILE__) . '/assets';
        parent::init();
    }

    public function run() {

        $wishListComponent = new WishListComponent();
        $this->isAdded = (in_array($this->pk, $wishListComponent->getIds())) ? true : false;
        $linkOptions = array();

        $class = ($this->isAdded) ? 'added' : '';
        $linkOptions['class'] = '';
        if (isset($this->linkOptions['class'])) {
            $linkOptions['class'] .= $this->linkOptions['class'];
        }
        $linkOptions['class'] .= ' ' . $class;
        $linkOptions['id'] = 'wishlist-' . $this->pk;

        $this->linkOptions = $linkOptions;
        $this->render($this->skin, array(
        ));
    }

}
