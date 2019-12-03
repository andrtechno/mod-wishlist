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
     * @var \panix\mod\wishlist\components\WishListComponent
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
        return parent::beforeAction($action);
    }

    /**
     * Render index view
     */
    public function actionIndex()
    {
        $this->pageName = Yii::t('wishlist/default', 'MY_WISHLIST');
        $this->view->title = $this->pageName;
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
        $this->model->add($id);
        $message = Yii::t('wishlist/default', 'SUCCESS_ADD');
        if (!Yii::$app->request->isAjax) {
            Yii::$app->session->setFlash('success', $message);
            return $this->redirect(['index']);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            Yii::$app->response->data = [
                'message' => $message,
                'btn_message' => Yii::t('wishlist/default', 'BTN_WISHLIST'),
                'count' => $this->model->count(),
                'title' => Yii::t('wishlist/default', 'ALREADY_EXIST')
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
     * @param int $id \panix\mod\shop\models\Product id
     * @return \yii\web\Response
     */
    public function actionRemove($id)
    {

        $this->model->remove($id);
        if (!Yii::$app->request->isAjax)
            return $this->redirect(['index']);
    }

}
