<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Marcação de Presenças');
$this->params['breadcrumbs'][] = $this->title;
$path = Yii::getAlias('@web');
$this->registerJsFile($path . "/js/script.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="cliente-listar-presencas">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalhes de <u><?= $cliente->Nome; ?></u>:</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Nome do Cliente') ?></strong></td>
                            <td><?= $cliente->Nome; ?></td>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Aulas Inscrito') ?></strong></td>
                            <td>
                                <table>
                                    <?php
                                    $user = $cliente->id;
                                    $estadoAulas = true;
                                    $estadoPack = true;
                                    echo '<tr>';
                                    echo '<td>';
                                    echo '<ul class="ul-bottom">';
                                    foreach ($registos as $registo):
                                        if (!empty($registo->inscricaos)) {
                                            foreach ($registo->inscricaos as $inscricao):
                                                if ($registo->Estado == 1) {
                                                    ?>
                                                    <li>
                                                        <?= Html::a($inscricao->aula->Nome, Url::to(['aula/view', 'id' => $inscricao->aula->id])); ?>
                                                        <?php
                                                        //$totalPresencas = count($registo->presencas);
//                                                        $numeroEntradas = 6;
//                                                        $class = $totalPresencas >= $numeroEntradas ? "red" : "green";
                                                        ?>
                                                        <!--(<span id="totalPresencas-aula-<?php // $registo->id  ?>" class="bold <?php // $class  ?>"><?php // $totalPresencas  ?></span>/<span data-max="<?php // $numeroEntradas  ?>" class="max-entradas bold"><?php // $numeroEntradas  ?></span>)-->
                                                    <!--Html::a('<span class="label label-success margin-btn-label add-presenca-aula" data-reg="' . $registo->id . '"  style="margin-left: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></span>', "#", ['style' => 'display: inline-block;', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Marcar Presença')]) -->
                                                    </li>
                                                    <?php
                                                    $estadoAulas = false;
                                                }
                                            endforeach;
                                        }
                                    endforeach;
                                    echo '</ul>';
                                    echo '</td>';
                                    echo '</tr>';
                                    if ($estadoAulas) {
                                        $renovar = '<span class="info-renovar"><label class="green">' . Html::a("Clica para inscrever", Url::to(["inscricao/aulas", 'ri' => 'renovacao', 'user' => $user])) . '</label></span>';
                                        echo '<span>-- Sem inscrição em aulas--</span> ' . '(' . $renovar . ')';
//                                        echo '<span>-- Sem inscrição em aulas--</span>';
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Pack Inscrito') ?></strong></td>
                            <?php
                            foreach ($registos as $registo):
                                if (!empty($registo->mensalidades)) {
                                    $registoId = $registo->id;
                                    foreach ($registo->mensalidades as $mensalidade):
                                        ?>
                                        <?= '<td>' . $mensalidade->pack->Nome . '</td>' ?>
                                        <?php
                                        $numeroEntradas = $mensalidade->NumeroEntradas; //0 não aparece o contador de presencas, porque é ilimitado
                                        $totalPresencas = count($mensalidade->presencas);
                                        $estado = $registo->Estado;
                                        $estadoPack = false;
                                    endforeach;
                                }
                            endforeach;
                            if ($estadoPack) {
                                echo '<td> -- Sem pack associado --</td>';
                                $estado = 0;
                            }
                            ?>
                        </tr>
                        <?php if (isset($numeroEntradas)): ?>
                            <?php if ($numeroEntradas != 0): ?>
                                <tr>
                                    <td class="text-right"><strong><?= Yii::t('app', 'Presenças') ?></strong></td>
                                    <td>
                                        <table>
                                            <tr>
                                                <?php if ($estado == 0): ?>
                                                    <td class="info-renovar"><label class="red"><?= Html::a('Registo Inativo', Url::to(['inscricao/musculacao', 'ri' => 'renovacao', 'user' => $user])); ?></label> <label class="green"><?= Html::a('(Clica para renovar)', Url::to(['inscricao/musculacao', 'ri' => 'renovacao', 'user' => $user])); ?></label></td>
                                                <?php else: ?>
                                                    <?php $class = $totalPresencas >= $numeroEntradas ? "red" : "green"; ?>
                                                    <td><span id="totalPresencas" class="bold <?= $class ?>"><?= $totalPresencas ?></span>/<span id="max-permitido" class="bold"><?= $numeroEntradas ?></span></td>
                                                    <td><?= Html::a('<span class="label label-success margin-btn-label" data-reg="' . $registoId . '"  style="margin-left: 10px;" id="add-presenca"><i class="fa fa-plus" aria-hidden="true"></i></span>', "#", ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Marcar Presença')]) ?></td>
                                                <?php endif; ?>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-right"><strong><?= Yii::t('app', 'Presenças') ?></strong></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td class="info-renovar"><label class="red"><?= Html::a('Registo Inativo', Url::to(['inscricao/musculacao', 'ri' => 'renovacao', 'user' => $user])); ?></label> <label class="green"><?= Html::a('(Clica para renovar)', Url::to(['inscricao/musculacao', 'ri' => 'renovacao', 'user' => $user])); ?></label></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>