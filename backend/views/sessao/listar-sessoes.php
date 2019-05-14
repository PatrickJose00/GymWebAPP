<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Sessao;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Sessões');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessao-listar-sessoes">
    <div class="row">
        <div class="col-xs-12">
            <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Sessão</span></h4>', Url::to(['sessao/adicionar']), ['title' => 'Adicionar Sessão', 'alt' => 'Adicionar Sessão']); ?>
            <div class="box">
                <?php
                $arrayDias = [];
                $arraySessoes = ['PrimeiraSessao', 'SegundaSessao'];
                $diasDaSemana = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $diasDaSemanaPT = ['Monday' => 'Segunda', 'Tuesday' => 'Terça', 'Wednesday' => 'Quarta', 'Thursday' => 'Quinta', 'Friday' => 'Sexta', 'Saturday' => 'Sábado', 'Sunday' => 'Domingo'];
                $i = 0;
                foreach ($sessoes as $sessao) {
                    foreach ($arraySessoes as $value) {
                        $_sessao = $sessao->$value;
                        $diaSemana = date('l', $_sessao);
                        $horaIncio = date('H\:i', $_sessao);
                        $horaFim = date('H\:i', $_sessao + $sessao->Duracao);
                        $professor = $sessao->aula->professor->Nome;
                        $aula = $sessao->aula->Nome;
                        $sala = $sessao->sala->Nome;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['id'] = $sessao->id;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['HoraInicio'] = $horaIncio;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['HoraFim'] = $horaFim;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['Professor'] = $professor;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['Aula'] = $aula;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['Sala'] = $sala;
                    }
                    $i++;
                }

                foreach ($arrayDias as $key => $item) {
                    $diasSemanaa[$key][] = $item;
                }

                foreach ($diasDaSemana as $semana_ordem => $dia_nome) {
                    if (isset($diasSemanaa[$dia_nome])) {
                        foreach ($diasSemanaa[$dia_nome] as $sp) {
                            $sorted_semana[$dia_nome] = $sp;
                        }
                    }
                }
                ?>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th><?= Yii::t('app', 'Início da Aula'); ?></th>
                            <th><?= Yii::t('app', 'Fim da Aula'); ?></th>
                            <th>Aula</th>
                            <th>Sala</th>
                            <th>Professor</th>
                            <th>Opções</th>
                        </tr>
                        <?php $count = 0; ?>
                        <?php foreach ($sorted_semana as $nameweek => $week): ?>
                            <tr>
                                <td colspan="8" class="text-center success"><b><?= Sessao::traduzirDiaSemana($nameweek) ?></b></td>
                            </tr>
                            <?php foreach ($week as $nameSport => $sport): ?>
                                <?php foreach ($sport as $details): ?>
                                    <tr>
                                        <td><?= ++$count ?></td>
                                        <td><?= $details['HoraInicio'] . 'h' ?></td>
                                        <td><?= $details['HoraFim'] . 'h' ?></td>
                                        <td><?= $nameSport ?></td>
                                        <td><?= $details['Sala'] ?></td>
                                        <td><?= $details['Professor'] ?></td>
                                        <td>
                                            <?=
                                            Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['sala/delete', 'id' => $details['id']]), ['data' => [
                                                    'confirm' => Yii::t('app', 'Pretendes apagar esta sessão?'),
                                                    'method' => 'post',
                                                ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>