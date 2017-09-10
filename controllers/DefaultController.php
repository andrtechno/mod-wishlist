<?php

namespace panix\mod\wishlist\controllers;

use Yii;
use panix\engine\controllers\WebController;
use panix\mod\wishlist\components\WishListComponent;

class DefaultController extends WebController {

    /**
     * @var Wishlist
     */
    public $model;

    public function beforeAction($action) {
        if (Yii::$app->user->isGuest && $this->action->id !== 'view') {
            Yii::$app->user->returnUrl = Yii::$app->request->getUrl();
            if (Yii::$app->request->isAjax)
                throw new CHttpException(302);
            else
                return $this->redirect(Yii::$app->user->loginUrl);
        }

        $this->model = new WishListComponent();
        return true;
    }

    /**
     * Render index view
     */
    public function actionIndex() {
        $this->pageName = Yii::t('wishlist/default', 'MODULE_NAME');
        $this->breadcrumbs[] = [
            'label' => $this->pageName,
            'url' => ['/wishlist']
        ];
        return $this->render('index');
    }

    /**
     * Add product to wish list
     * @param $id ShopProduct id
     */
    public function actionAdd($id) {
        $this->model->add($id);
        $message = Yii::t('wishlist/default', 'SUCCESS_ADD');
        $this->addFlashMessage($message);
        if (!Yii::$app->request->isAjax) {
            return $this->redirect($this->createUrl('index'));
        } else {
            echo Json::encode(array(
                'message' => $message,
                'btn_message' => Yii::t('wishlist/default', 'BTN_WISHLIST'),
                'count' => $this->model->count()
            ));
        }
    }

    /**
     * @param $key
     * @throws CHttpException
     */
    public function actionView($key) {
        try {
            $this->model->loadByKey($key);
        } catch (CException $e) {
            $this->error404(Yii::t('wishlist/default', 'ERROR_VIEW'));
        }

        return $this->render('index');
    }

    /**
     * Remove product from list
     * @param string $id product id
     */
    public function actionRemove($id) {
        $this->model->remove($id);
        if (!Yii::$app->request->isAjax)
            return $this->redirect($this->createUrl('index'));
    }

}
