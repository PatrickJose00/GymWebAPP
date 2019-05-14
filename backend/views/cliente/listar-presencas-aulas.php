<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aulas Presente');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cliente-listar-presencas">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="alert alert-info">
        <strong>Informação</strong> <br> Aulas a decorrer não serão aqui apresentadas.
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding" style="overflow-x: visible !important;">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th>Aula</th>
                            <th>Data Inscrição</th>
                            <th>Estado</th>
                        </tr>
                        <?php
                        $aulas = true;
                        $count = 0;
                        foreach ($presencas as $presenca):
                            if (!empty($presenca->inscricao)) {
                                echo '<tr>';
                                ?>
                                <td><?= ++$count; ?></td>
                                <td><?= Html::a($presenca->inscricao->aula->Nome, Url::to(['aula/view', 'id' => $presenca->inscricao->aula->id])); ?></td>
                                <td><?= date('d-M-Y', $presenca->Data) ?></td>
                                <td>Concluído</td>
                                <?php
                                $aulas = false;
                                echo '</tr>';
                            }
                        endforeach;
                        if ($aulas) {
                            echo '<span>--Sem presenças--</span>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
