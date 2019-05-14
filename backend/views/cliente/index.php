<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Clientes');
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias('@web');
$this->registerJsFile($path . "/js/script.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="cliente-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-check-circle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <div class="search-bar">
        <div class="row">
            <div class="col-md-12">
                <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Cliente</span></h4>', Url::to(['cliente/create']), ['title' => 'Adicionar Cliente', 'alt' => 'Adicionar Cliente']); ?>
                <?= Html::beginForm(['cliente/index'], 'get'); ?>
                <div class="input-group">
                    <?= Html::input('text', 'search', null, ['class' => 'form-control', 'placeholder' => Yii::t('app', 'Pesquisar por..')]); ?>
                    <div class="input-group-btn" style="width: 170px;">
                        <?php
                        $values = ['nome' => 'Nome', 'numero' => Yii::t('app', 'Número Cliente'), 'email' => 'E-mail'];
                        ?>
                        <?= Html::dropDownList('list', null, $values, ['class' => 'form-control']); ?>

                    </div>
                    <span class="input-group-btn">
                        <button class="btn uppercase bold" type="submit"><?= Yii::t('app', 'Pesquisar') ?></button>
                    </span>
                </div>
                <?= Html::endForm(); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding" style="overflow-x: visible !important;">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th class="text-center"><?= Yii::t('app', 'Número de Cliente') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Nome do Cliente')  ?></th>
                            <th class="text-center"><?= Yii::t('app', 'E-mail') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Morada') ?></th>
<!--                            <th class="text-center"><?php// Yii::t('app', 'Número de Contribuinte') ?></th>-->
                            <th class="text-center"><?= Yii::t('app', 'Seguro') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Telefone') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Aulas Inscrito') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Mensalidade') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Histórico Mensalidades') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Data de Registo') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Opções') ?></th>

                        </tr>
                        <?php
                        $count = 1;
                        if (!empty($clientes)):
                            foreach ($clientes as $cliente):
                                $estadoMensalidade = true;
                                $estadoAulas = true;
                                ?>
                                <tr>
                                    <td class="text-center"><strong><?= $count++; ?></strong></td>
        <!--                                    <td><?php //Html::img(Yii::getAlias('@web') . '/professores/' . $cliente->Foto, ['class' => 'img-thumbnail img-aula center-block', 'alt' => $cliente->Nome, 'title' => $cliente->Nome]);                                         ?></td>-->
                                    <td class="text-center"><?= $cliente->user->username ?></td>
                                    <td class="text-center"><?= $cliente->Nome ?></td>
                                    <td class="text-center"><?= $cliente->user->email ?></td>
                                    <td class="text-center"><?= wordwrap($cliente->morada->Endereco, 30, '<br>') ?></td>
        <!--                                    <td class="text-center"><?php //$cliente->Contribuinte  ?></td>-->
                                    <td class="text-center">
                                        <?php
                                        if ($cliente->seguro->Estado == 1) {
                                            $oneYear = strtotime('+1 year', $cliente->seguro->DataCriacao);
                                            $difference = $oneYear - time();
                                            $days = floor($difference / (60 * 60 * 24));
                                            echo "Ativo (expira em " . $days . " dia(s))";
                                        } else {
                                            echo "Expirou";
                                        }
                                        ?></td>
                                    <td class="text-center"><?= chunk_split($cliente->Telefone, 3) ?></td>
                                    <td class="text-center">
                                        <?php
                                        $showUl = true;
                                        foreach ($cliente->registos as $registo) {
                                            if (!empty($registo->inscricaos)) {
                                                if ($registo->Estado == 1):
                                                    foreach ($registo->inscricaos as $inscricao):
                                                        if ($showUl):
                                                            echo '<ul class="ul-bottom">';
                                                            $showUl = false;
                                                        endif;
                                                        $estadoAulas = false;
                                                        echo '<li>' . Html::a($inscricao->aula->Nome, Url::to(['aula/view', 'id' => $inscricao->aula->id])) . '</li>';
                                                    endforeach;
                                                endif;
                                            }
                                        }
                                        if (!$showUl):
                                            echo '</ul>';
                                        endif;
                                        if ($estadoAulas) {
                                            echo '-- Não inscrito --';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        foreach ($cliente->registos as $registo) {
                                            foreach ($registo->mensalidades as $mensalidade) {
                                                if ($registo->Estado == 1) {
                                                    $estadoMensalidade = false;
                                                    echo ($mensalidade->pack->Nome);
                                                }
                                            }
                                        }
                                        if ($estadoMensalidade) {
                                            echo '-- Não inscrito --';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><?= Html::a('Ver', ['cliente/historico-mensalidades', 'id' => $cliente->id]); ?></td>
                                    <td class="text-center"><?= date('d-M-Y', $cliente->user->created_at) ?></td>
                                    <td class="text-center">
                                        <?= Html::a('<span class="label label-success margin-btn-label"><i class="fa fa-eye" aria-hidden="true"></i></span>', Url::to(['cliente/view', 'id' => $cliente->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizar')]); ?>
                                        <?= Html::a('<span class="label label-warning margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['cliente/update', 'id' => $cliente->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                        <?= Html::a('<span class="label label-primary margin-btn-label"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>', Url::to(['cliente/marcar-presenca', 'id' => $cliente->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Marcar Presença')]); ?>
                                        <?= Html::a('<span class="label label-default margin-btn-label"><i class="fa fa-calendar" aria-hidden="true"></i></span>', '#', ['data-target' => '#modal', 'data-content' => Url::to(['atribuir-plano', 'id' => $cliente->id]), 'id' => 'modal-btn', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Plano Exercício')]); ?>
                                        <?= Html::a('<span class="label label-default margin-btn-label"><i class="fa fa-apple" aria-hidden="true"></i></span>', '#', ['data-target' => '#modal', 'data-content' => Url::to(['atribuir-plano-nutricao', 'id' => $cliente->id]), 'id' => 'modal-btn', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Plano Nutrição')]); ?>
                                        <?php
//                                        Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['cliente/delete', 'id' => $cliente->id]), ['data' => [
//                                                'confirm' => Yii::t('app', 'Pretendes apagar este cliente?'),
//                                                'method' => 'post',
//                                            ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            echo '<tr><td colspan="12" class="text-center"><strong>-- Sem clientes para mostrar --</strong></td></tr>';
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?=
    LinkPager::widget([
        'pagination' => $pages,
        'maxButtonCount' => 4,
        'lastPageLabel' => '»»',
        'firstPageLabel' => '««',
        'options' => ['class' => 'pagination pull-right']
    ])
    ?>
</div>

<?php
Modal::begin([
    'id' => 'modal',
    'header' => '<h2>Atribuir Plano</h2>',
]);

echo "<div id='modal-content'></div>";

Modal::end();
?>