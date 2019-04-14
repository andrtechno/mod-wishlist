<?php

namespace panix\mod\wishlist\controllers;


use Yii;
use panix\engine\controllers\WebController;
use panix\mod\wishlist\components\WishListComponent;
use yii\web\HttpException;
use yii\web\Response;

class DefaultController extends WebController
{

    /**
     * @var \panix\mod\wishlist\models\Wishlist
     */
    public $model;

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && $this->action->id !== 'view') {
            Yii::$app->user->returnUrl = Yii::$app->request->getUrl();
            if (Yii::$app->request->isAjax)
                throw new HttpException(302);
            else
                return $this->redirect(Yii::$app->user->loginUrl);
        }

        $this->model = new WishListComponent();
        return true;
    }

    /**
     * Render index view
     */
    public function actionIndex()
    {
        $this->pageName = Yii::t('wishlist/default', 'MODULE_NAME');
        $this->breadcrumbs[] = [
            'label' => $this->pageName,
            'url' => ['/wishlist']
        ];
        // $this->model = new WishListComponent();
        return $this->render('index');
    }

    /**
     * Add product to wish list
     *
     * @param $id \panix\mod\shop\models\Product id
     * @return \yii\web\Response
     */
    public function actionAdd($id)
    {
        /* @method add \panix\mod\wishlist\models\Wishlist */
        $this->model->add($id);
        $message = Yii::t('wishlist/default', 'SUCCESS_ADD');
        //$this->addFlashMessage($message);
        Yii::$app->session->setFlash('success', $message);
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(['index']);
        } else {

            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->data = [
                'message' => $message,
                'btn_message' => Yii::t('wishlist/default', 'BTN_WISHLIST'),
                'count' => $this->model->count()
            ];
        }
    }

    /**
     *
     *
     * @param $key
     * @return string
     */
    public function actionView($key)
    {
        try {
            $this->model->loadByKey($key);
        } catch (HttpException $e) {
            $this->error404(Yii::t('wishlist/default', 'ERROR_VIEW'));
        }

        return $this->render('index');
    }

    /**
     * Remove product from list
     *
     * @param $id \panix\mod\shop\models\Product id
     * @return \yii\web\Response
     */
    public function actionRemove($id)
    {

        $this->model->remove($id);
        if (!Yii::$app->request->isAjax)
            return $this->redirect(['index']);
    }

}
