<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Histório de Planos');
$this->params['breadcrumbs'][] = ['url' => ['cliente/index'], 'label' => 'Listagem de Clientes'];
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding" style="overflow-x: visible !important;">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th class="text-center"><?= Yii::t('app', 'Nome do Plano') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Exercícios') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Data de Adesão') ?></th>

                        </tr>
                        <?php
                        $count = 1;
                        if (!empty($planosTreinoCliente)):
                            foreach ($planosTreinoCliente as $planoCliente):
                                ?>
                                <tr>
                                    <td class="text-center"><strong><?= $count++; ?></strong></td>
                                    <td class="text-center"><?= $planoCliente->planosDeTreino->Nome ?></td>
                                    <td class="text-center">
                                        <?php if (!empty($planoCliente->planosDeTreino->exercicioPlanos)): ?>
                                            <ul>
                                                <?php foreach ($planoCliente->planosDeTreino->exercicioPlanos as $exec): ?>
                                                    <li><?= $exec->exercicios->Nome ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else: ?>
                                            <span>-- Sem exercícios para este plano --</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?= date('d-M-Y \à\s H:i\h', $planoCliente->Data) ?></td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            echo '<tr><td colspan="12" class="text-center"><strong>-- Sem planos para mostrar --</strong></td></tr>';
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
//    LinkPager::widget([
//        'pagination' => $pages,
//        'maxButtonCount' => 4,
//        'lastPageLabel' => '»»',
//        'firstPageLabel' => '««',
//        'options' => ['class' => 'pagination pull-right']
//    ])
    ?>
</div>