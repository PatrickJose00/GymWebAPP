<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */
$this->title = $model->exercicios->categoriaExercicio->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem Planos de Treino'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->exercicios->categoriaExercicio->Nome;
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
<div class="planoexercicio-view">
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
                    <h3 class="box-title">Detalhes de <u><?= $model->exercicios->categoriaExercicio->Nome ?></u>:</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <?php
                        switch ($model->Dia):
                            case "1":
                                $model->Dia = "Segunda";
                                break;
                            case "2":
                                $model->Dia = "Terça";
                                break;
                            case "3":
                                $model->Dia = "Quarta";
                                break;
                            case "4":
                                $model->Dia = "Quinta";
                                break;
                            case "5":
                                $model->Dia = "Sexta";
                                break;
                            case "6":
                                $model->Dia = "Sábado";
                                break;
                            case "7":
                                $model->Dia = "Domingo";
                                break;
                        endswitch;
                        ?>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Plano de Treino'); ?></strong></td>
                            <td><?= $model->planoDeTreino->Nome ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Dia'); ?></strong></td>
                            <td><?= $model->Dia ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Músculo'); ?></strong></td>
                            <td><?= $model->exercicios->categoriaExercicio->Nome ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Exercício'); ?></strong></td>
                            <td><?= $model->exercicios->Nome ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Repetições'); ?></strong></td>
                            <td><?= $model->Repeticoes ?>x</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Carga'); ?></strong></td>
                            <td><?= $model->Carga ?>kg</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Pausa'); ?></strong></td>
                            <td><?= $model->Pausa ?> seg</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Séries'); ?></strong></td>
                            <td><?= $model->Series ?>x</td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Imagem'); ?></strong></td>
                            <td><?= Html::img(Yii::getAlias('@web') . '/exercicios/' . $model->exercicios->Foto, ['class' => 'img-thumbnail', 'width' => 200, 'alt' => $model->exercicios->Nome, 'title' => $model->exercicios->Nome]) ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Opções</strong></td>
                            <td>
                                <?= Html::a('<span class="btn btn-warning btn-sm margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i> Atualizar</span>', Url::to(['planoexercicio/update', 'id' => $model->id])); ?>
                                <?=
                                Html::a('<span class="btn btn-danger btn-sm margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</span>', Url::to(['planoexercicio/delete', 'id' => $model->id]), ['data' => [
                                        'confirm' => Yii::t('app', 'Pretendes apagar este exercício?'),
                                        'method' => 'post',
                                ]]);
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
