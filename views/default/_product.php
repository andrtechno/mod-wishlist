<?php
use yii\helpers\Html;
?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 product text-left">
    <div class="product-box">
        <div class="product-image-box">
            <div class="thumbnail">

            <?php

            echo Html::a(Html::img($data->getMainImageUrl('240x240'), $data->mainImageTitle, array('class' => 'img-responsive', 'height' => 240)), $data->getUrl(), array('class' => ''));
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
    <sup><?= Yii::$app->currency->active->symbol ?></sup>
</div>

<?php
echo Html::beginForm(['/cart/add'], 'post', ['id' => 'form-add-cart-' . $data->id]);
echo Html::hiddenInput('product_id', $data->id);
echo Html::hiddenInput('product_price', $data->price);
echo Html::hiddenInput('use_configurations', $data->use_configurations);
echo Html::hiddenInput('currency_rate', Yii::$app->currency->active->rate);
echo Html::hiddenInput('currency_id', $data->currency_id);
echo Html::hiddenInput('supplier_id', $data->supplier_id);
echo Html::hiddenInput('configurable_id', 0);
?>
<div class="text-center product-action">
    <div class="btn-group btn-group-sm">
        <?php
        if (Yii::$app->hasModule('compare')) {
            //$this->widget('mod.compare.widgets.CompareWidget', array('pk' => $data->id));
        }
        if ($data->isAvailable) {
            echo Html::a(Yii::t('app', 'BUY'), 'javascript:cart.add("#form-add-cart-' . $data->id . '")', array('class' => 'btn btn-success'));
        } else {
            echo Html::a(Yii::t('app', 'NOT_AVAILABLE'), 'javascript:cart.notifier(' . $data->id . ');', array('class' => 'btn btn-link'));
        }
        ?>
    </div>
</div>
<?php
if ($this->context->model->getUserId() === Yii::$app->user->id) {
    echo Html::a(Yii::t('app', 'DELETE'), array('remove', 'id' => $data->id), array(
        'class' => 'btn btn-primary remove',
    ));
}else{
    echo 'no user';
}
echo Html::endForm();
?>
    </div>
</div>