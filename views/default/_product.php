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

                echo Html::a(Html::img($data->getMainImage('240x240')->url, ['alt' => '', 'class' => 'img-fluid', 'height' => 240]), $data->getUrl(), array('class' => ''));
                ?>
            </div>
        </div>

        <?php echo Html::a(Html::encode($data->name), $data->getUrl()) ?>

        <div class="product-price">
    <span class="price">
        <?php
        if (Yii::$app->hasModule('discounts')) {
            if ($data->appliedDiscount) {
                echo '<span style="color:red; "><s>' . $data->toCurrentCurrency('originalPrice') . '</s></span>';
            }
        }
        ?>
        <?= $data->priceRange() ?></span>
            <sup><?= Yii::$app->currency->active['symbol'] ?></sup>
        </div>

        <?php
        echo $data->beginCartForm();
        ?>
        <div class="text-center product-action">
            <div class="btn-group">
                <?php
                if (Yii::$app->hasModule('compare')) {
                    //$this->widget('mod.compare.widgets.CompareWidget', array('pk' => $data->id));
                }
                if ($data->isAvailable) {
                    echo Html::a(Yii::t('cart/default', 'BUY'), 'javascript:cart.add("#form-add-cart-' . $data->id . '")', array('class' => 'btn btn-warning'));
                } else {
                    echo Html::a(Yii::t('app', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $data->id . ');', array('class' => 'btn btn-link'));
                }
                ?>
            </div>
        </div>
        <?php
        if ($component->getUserId() === Yii::$app->user->id) {
            echo Html::a(Yii::t('app', 'DELETE'), ['remove', 'id' => $data->id], [
                'class' => 'btn btn-danger remove',
            ]);
        } else {
            echo 'no user';
        }

        ?>
        <?php
        echo $data->endCartForm();
        ?>
    </div>
</div>