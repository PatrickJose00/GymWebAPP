<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$js = <<<JS
window.setTimeout(function() {
    $(".alert-slide").fadeTo(800, 0).slideUp(600, function(){
        $(this).remove(); 
        });
    }, 5000);
;
JS;
$this->registerJs($js);
?>
<div class="cliente-view">
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
                    <h3 class="box-title">Detalhes de <u><?= $model->Nome ?></u>:</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
<!--                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Foto'); ?></strong></td>
                            <td><?php //Html::img(Yii::getAlias('@web') . '/professores/' . $model->Foto, ['class' => 'img-thumbnail', 'width' => 200, 'alt' => $model->Nome, 'title' => $model->Nome])               ?></td>
                        </tr>-->
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('User_id'); ?></strong></td>
                            <td><?= $model->user->username ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Nome'); ?></strong></td>
                            <td><?= $model->Nome ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Email'); ?></strong></td>
                            <td><?= $model->user->email ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Contribuinte'); ?></strong></td>
                            <td><?= $model->Contribuinte ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Seguro'); ?></strong></td>
                            <td><?php
                                if ($model->seguro->Estado == 1) {
                                    $oneYear = strtotime('+1 year', $model->seguro->DataCriacao);
                                    $difference = $oneYear - time();
                                    $days = floor($difference / (60 * 60 * 24));
                                    echo "Ativo (expira em " . $days . " dia(s))";
                                } else {
                                    echo "Expirou";
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Telefone'); ?></strong></td>
                            <td><?= chunk_split($model->Telefone, 3) ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Morada'); ?></strong></td>
                            <td><?= wordwrap($model->morada->Endereco, 40, '<br>') ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Aulas'); ?></strong></td>
                            <td>
                                <?php
                                $user = $model->id;
                                $showUl = true;
                                $estadoAulas = true;
                                foreach ($model->registos as $registo) {
                                    if (!empty($registo->inscricaos)) {
                                        if ($registo->Estado == 1) {
                                            foreach ($registo->inscricaos as $inscricao):
                                                if ($showUl):
                                                    echo '<ul class="ul-bottom">';
                                                    $showUl = false;
                                                endif;
                                                $estadoAulas = false;
                                                echo '<li>' . Html::a($inscricao->aula->Nome, Url::to(['aula/view', 'id' => $inscricao->aula->id])) . '</li>';
                                            endforeach;
                                        }
                                    }
                                }
                                if (!$showUl):
                                    echo '</ul>';
                                endif;
                                if ($estadoAulas) {
                                    $renovar = '<span class="info-renovar"><label class="green">' . Html::a("Clica para inscrever", Url::to(["inscricao/aulas", 'ri' => 'renovacao', 'user' => $user])) . '</label></span>';
                                    echo '<span>-- Sem inscrição em aulas--</span> ' . '(' . $renovar . ')';
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Mensalidade'); ?></strong></td>
                            <td>
                                <?php
                                $estadoMensalidade = true;
                                foreach ($model->registos as $registo) {
                                    foreach ($registo->mensalidades as $mensalidade) {
                                        if ($registo->Estado == 1) {
                                            $estadoMensalidade = false;
                                            echo ($mensalidade->pack->Nome);
                                        }
                                    }
                                }
                                if ($estadoMensalidade):
                                    ?>
                                    <label class="red"><?= Html::a('Não inscrito', Url::to(['inscricao/musculacao', 'ri' => 'renovacao', 'user' => $user])); ?></label> <label class="green"><?= Html::a('(Clica para inscrever/renovar)', Url::to(['inscricao/musculacao', 'ri' => 'renovacao', 'user' => $user])); ?></label>
                                    <?php
                                endif;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Registo'); ?></strong></td>
                            <td><?= date('d-M-Y', $model->user->created_at) ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Opções</strong></td>
                            <td>
                                <?= Html::a('<span class="btn btn-warning btn-sm margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i> Atualizar</span>', Url::to(['cliente/update', 'id' => $model->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                <?php
//                                Html::a('<span class="btn btn-danger btn-sm margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</span>', Url::to(['cliente/delete', 'id' => $model->id]), ['data' => [
//                                        'confirm' => Yii::t('app', 'Pretendes apagar este cliente?'),
//                                        'method' => 'post',
//                                    ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
