<?php
use panix\engine\bootstrap\Alert;

$component = Yii::$app->wishlist;
?>

    <h1><?= $this->context->pageName; ?></h1>


<?php if ($component->products) { ?>

    <a class="btn btn-primary"
       href="mailto:?body=<?= $component->getUrl() ?>&subject=<?= Yii::t('wishlist/default', 'SUBJECT_NAME') ?>"><?= Yii::t('app', 'SEND') ?></a>

    <div class="list-view _view_grid">
        <?php
        foreach ($component->products as $p) {
            echo $this->render('_product', [
                'data' => $p,
                'component' => $component
            ]);
        }
        ?>
    </div>
    <div class="clearfix"></div>
<?php } else { ?>
    <?php
    echo Alert::widget([
        'options' => [
            'class' => 'alert-info',
        ],
        'closeButton' => false,
        'body' => Yii::t('wishlist/default', 'EMPTY_LIST'),
    ]);
    ?>
<?php } ?>