<?php

namespace panix\mod\wishlist\controllers;


use Yii;
use panix\engine\controllers\WebController;
use panix\mod\wishlist\components\WishListComponent;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
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
        /*if (Yii::$app->user->isGuest && $this->action->id !== 'view') {
            Yii::$app->user->returnUrl = Yii::$app->request->getUrl();
            if (Yii::$app->request->isAjax)
                throw new HttpException(302);
            else
                return $this->redirect(Yii::$app->user->loginUrl);
        }*/

        $this->model = new WishListComponent();
        return parent::beforeAction($action);
    }

    /**
     * Render index view
     */
    public function actionIndex()
    {
        $this->pageName = Yii::t('wishlist/default', 'MODULE_NAME');
        $this->view->title = $this->pageName;
        $this->view->params['breadcrumbs'][] = [
            'label' => $this->pageName,
            'url' => ['index']
        ];
        // $this->model = new WishListComponent();
        return $this->render('index');
    }

    /**
     * Add product to wish list
     *
     * @param $id \panix\mod\shop\models\Product id
     * @return Response
     */
    public function actionAdd($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data['success'] = false;
        $data['message'] = 'Error 403';
        $message = Yii::t('wishlist/default', 'SUCCESS_ADD');
        if (Yii::$app->request->isAjax || Yii::$app->request->isPjax) {
            if ($this->model->add($id)) {
                $data['success'] = true;
                $data['message'] = $message;
                $data['btn_message'] = Yii::t('wishlist/default', 'BTN_WISHLIST');
                $data['count'] = $this->model->count();
                $data['title'] = Yii::t('wishlist/default', 'ALREADY_EXIST');
                $data['url'] = Url::to(['/wishlist/default/remove', 'id' => $id]);
                $data['id'] = $id;
                $data['action'] = 'add';
            }

        }
        return $this->asJson($data);
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
     * @return ForbiddenHttpException|Response
     */
    public function actionRemove($id)
    {
        $message = Yii::t('wishlist/default', 'DELETE_SUCCESS');
        if ((Yii::$app->request->isAjax || Yii::$app->request->isPjax) && $this->model) {
            $this->model->remove($id);
            $data['success'] = true;
            $data['message'] = $message;
            $data['btn_message'] = Yii::t('wishlist/default', 'BTN_WISHLIST');
            $data['count'] = $this->model->count();
            $data['url'] = Url::to(['/wishlist/default/add', 'id' => $id]);
            $data['id'] = $id;
            $data['action'] = 'remove';
            return $this->asJson($data);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return new ForbiddenHttpException();
        }
    }

}
