<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it. 
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
            'main-login', ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
        </head>
        <body class="hold-transition skin-blue sidebar-mini">
            <?php $this->beginBody() ?>
            <div class="wrapper">

                <?=
                $this->render(
                        'header.php', ['directoryAsset' => $directoryAsset]
                )
                ?>

                <?=
                $this->render(
                        'left.php', ['directoryAsset' => $directoryAsset]
                )
                ?>
                <div class="content-wrapper">
                    <section class="content-header">
                        <h1><?= $this->title ?></h1>
                        <?=
                        Breadcrumbs::widget([
                            'tag' => 'ol',
                            'itemTemplate' => "<li>{link}</li>\n",
                            'homeLink' => [
                                'label' => Yii::t('app', 'Página Inicial'),
                                'url' => ['site/index'],
                            ],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]);
                        ?>
                    </section>
                    <section class="content">
                        <?= $content ?>
                    </section>
                </div>
                <footer class="main-footer">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> 2.0
                    </div>
                    <strong>Copyright &copy; <?= date("Y"); ?></strong>
                </footer>
            </div>
            <?php $this->endBody() ?>
        </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
