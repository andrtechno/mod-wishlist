<?php
use yii\helpers\Html;

/**
 * @var $data \panix\mod\shop\models\Product;
 */
?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product text-left">
    <div class="product-box">
        <div class="product-image-box">
            <div class="thumbnail">

                <?php

                echo Html::a(Html::img($model->getMainImage('240x240')->url, ['alt' => '', 'class' => 'img-fluid', 'height' => 240]), $model->getUrl(), ['class' => '']);
                ?>
            </div>
        </div>

        <?php echo Html::a(Html::encode($model->name), $model->getUrl()) ?>

        <div class="product-price">
    <span class="price">
        <?php
        if (Yii::$app->hasModule('discounts')) {
            if ($model->hasDiscount) {
                echo '<span style="color:red; "><s>' . $model->toCurrentCurrency('originalPrice') . '</s></span>';
            }
        }
        ?>
        <?= $model->priceRange() ?></span>
            <sup><?= Yii::$app->currency->active['symbol'] ?></sup>
        </div>

        <?php
        echo $model->beginCartForm();
        ?>
        <div class="text-center product-action">
            <div class="btn-group">
                <?php
                if (Yii::$app->hasModule('compare')) {
                    //$this->widget('mod.compare.widgets.CompareWidget', array('pk' => $model->id));
                }
                if ($model->isAvailable) {
                    echo Html::a(Yii::t('cart/default', 'BUY'), 'javascript:cart.add("#form-add-cart-' . $model->id . '")', ['class' => 'btn btn-warning']);
                } else {
                    echo Html::a(Yii::t('app/default', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $model->id . ');', ['class' => 'btn btn-link']);
                }
                ?>
            </div>
        </div>
        <?php
        if ($component->getUserId() === Yii::$app->user->id) {
            echo Html::a(Yii::t('app/default', 'DELETE'), ['remove', 'id' => $model->id], [
                'class' => 'btn btn-danger remove',
            ]);
        } else {
            echo 'no user';
        }

        ?>
        <?php
        echo $model->endCartForm();
        ?>
    </div>
</div>