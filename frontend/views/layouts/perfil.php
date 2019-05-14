<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?= $this->render('header'); ?>
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?php Alert::widget() ?>
            <div class="mainbody container-fluid">
                <div style="padding-top: 50px"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="media">
                                        <div align="center">
                                            <img class="thumbnail img-responsive" src="https://lut.im/7JCpw12uUT/mY0Mb78SvSIcjvkf.png" width="300px" height="300px">
                                        </div>
                                        <div class="media-body">
                                            <hr>
                                            <?php
                                            if (isset($this->params['user'])):
                                                switch ($this->params['user']->cliente->Genero) {
                                                    case "0":
                                                        $result = "Masculino";
                                                        break;
                                                    case "1":
                                                        $result = "Feminino";
                                                        break;
                                                    case "2":
                                                        $result = "Outro";
                                                        break;
                                                }
                                                ?>
                                                <h4><strong>Nome</strong></h4>
                                                <p><?= $this->params['user']->cliente->Nome ?></p>
                                                <hr>
                                                <h4><strong>Morada</strong></h4>
                                                <p><?= $this->params['user']->cliente->morada->Endereco ?></p>
                                                <hr>
                                                <h4><strong>Género</strong></h4>
                                                <p><?= $result ?></p>
                                                <hr>
                                                <h4><strong>Data Nascimento</strong></h4>
                                                <p><?= date('d-M-Y', $this->params['user']->cliente->DataNascimento) ?></p>
                                            <?php endif; ?>
                                            <?php if (isset($this->params['mensalidadeAtual'])): ?>
                                                <hr>
                                                <?php foreach ($this->params['mensalidadeAtual'] as $registo): ?>
                                                    <?php foreach ($registo->mensalidades as $value): ?>
                                                        <h4><strong>Mensalidade Atual</strong></h4>
                                                        <p><?= $value->pack->Nome ?></p>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <span>
                                        <div class="pull-left">
                                            <?= Html::a('<span class="btn-sm btn-home margin-btn-add"><i class="fa fa-home fa-2" aria-hidden="true"></i></span>', Url::to(['perfil/index']), ['title' => 'Perfil', 'alt' => 'Perfil']); ?>
                                            <?= Html::a('<span class="btn-sm btn-success margin-btn-add">Atualizar Dados</span>', Url::to(['perfil/definicoes-conta']), ['title' => 'Atualizar Dados', 'alt' => 'Atualizar Dados']); ?>
                                            <?= Html::a('<span class="btn-sm btn-warning margin-btn-add">Histórico de Mensalidades</span>', Url::to(['perfil/historico-mensalidades']), ['title' => 'Histórico de Mensalidades', 'alt' => 'Histórico de Mensalidades']); ?>
                                            <?= Html::a('<span class="btn-sm btn-primary margin-btn-add">Histórico de Aulas</span>', Url::to(['perfil/historico-aulas']), ['title' => 'Histórico de Aulas', 'alt' => 'Histórico de Aulas']); ?>
                                            <?= Html::a('<span class="btn-sm btn-danger margin-btn-add">Planos de Treino</span>', Url::to(['perfil/historico-plano-exercicios']), ['title' => 'Planos Exercício', 'alt' => 'Planos Exercício']); ?>
                                            <?= Html::a('<span class="btn-sm btn-info margin-btn-add">Planos Nutrição</span>', Url::to(['perfil/historico-plano-nutricao']), ['title' => 'Planos Nutrição', 'alt' => 'Planos Nutrição']); ?>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <?= $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; AgonGym <?= date('Y') ?></p>

                <p class="pull-right"></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>