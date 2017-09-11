

<h1><?= $this->context->pageName; ?></h1>

<?php if (!empty($this->context->model->products)) { ?>

    <a class="btn btn-primary" href="mailto:?body=<?= $this->context->model->getUrl() ?>&subject=<?= Yii::t('wishlist/default', 'SUBJECT_NAME') ?>"><?= Yii::t('app', 'SEND') ?></a>

    <div class="products_list wish_list">
        <?php
        foreach ($this->context->model->products as $p) {
            echo $this->render('_product', ['data' => $p]);
        }
        ?>
    </div>
<?php } else { ?>
    <?php echo Yii::t('wishlist/default', 'EMPTY_LIST'); ?>
<?php } ?>