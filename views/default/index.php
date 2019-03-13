<h1><?= $this->context->pageName; ?></h1>


<?php
$component = Yii::$app->wishlist;


?>


<?php if ($component->products) { ?>

    <a class="btn btn-primary" href="mailto:?body=<?= $component->getUrl() ?>&subject=<?= Yii::t('wishlist/default', 'SUBJECT_NAME') ?>"><?= Yii::t('app', 'SEND') ?></a>

    <div class="products_list wish_list">
        <?php
        foreach ($component->products as $p) {

            echo $this->render('_product', [
                    'data' => $p,
                'component'=>$component
            ]);
        }
        ?>
    </div>
<?php } else { ?>
    <?php echo Yii::t('wishlist/default', 'EMPTY_LIST'); ?>
<?php } ?>