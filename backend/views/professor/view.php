<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Professor */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Professores'), 'url' => ['index']];
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
<div class="professor-view">
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
                        <tr>

                            <td class="text-right"><strong><?= $model->getAttributeLabel('Nome'); ?></strong></td>
                            <td><?= $model->Nome ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Email'); ?></strong></td>
                            <td><?= $model->Email ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('DataNascimento'); ?></strong></td>
                            <td><?= date('d-M-Y', $model->DataNascimento) ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('BI'); ?></strong></td>
                            <td><?= $model->BI ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Contribuinte'); ?></strong></td>
                            <td><?= $model->Contribuinte ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Aula(s)') ?></strong></td>
                            <td>
                                <?php
                                if (!empty($model->aulas)):
                                    echo '<ul>';
                                    foreach ($model->aulas as $aula):
                                        ?>
                                <li><?= Html::a($aula->Nome, Url::to(['aula/view', 'id' => $aula->id])); ?></li>
                                <?php
                            endforeach;
                            echo '</ul>';
                        else:
                            echo '<span>--Sem aulas--</span>';
                        endif;
                        ?>
                        </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Foto'); ?></strong></td>
                            <td><?= Html::img(Yii::getAlias('@web') . '/professores/' . $model->Foto, ['class' => 'img-thumbnail', 'width' => 200, 'alt' => $model->Nome, 'title' => $model->Nome]) ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Opções</strong></td>
                            <td>
                                <?= Html::a('<span class="btn btn-warning btn-sm margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i> Atualizar</span>', Url::to(['professor/update', 'id' => $model->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                <?=
                                Html::a('<span class="btn btn-danger btn-sm margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</span>', Url::to(['professor/delete', 'id' => $model->id]), ['data' => [
                                        'confirm' => Yii::t('app', 'Pretendes apagar este professor?'),
                                        'method' => 'post',
                                    ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>