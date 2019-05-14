<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Pack */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Mensalidades'), 'url' => ['index']];
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
<div class="modalidade-view">
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
                            <td class="text-right"><strong><?= Yii::t('app', 'Descrição') ?></strong></td>
                            <td>
                                <?php
                                if (!empty($model->Descricao)):
                                    $descricoes = explode(',', $model->Descricao);
                                    echo '<ul class="ul-bullet-view">';
                                    foreach ($descricoes as $descricao):
                                        ?>
                                <li><p><?= $descricao ?></p></li>
                                <?php
                            endforeach;
                            echo '</ul>';
                        else:
                            echo '<span>--Sem detalhes--</span>';
                        endif;
                        ?>
                        </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('NumeroEntradas'); ?></strong></td>
                            <td><?= $model->NumeroEntradas ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Preco') ?></strong></td>
                            <td><?= $model->Preco . '€'?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Opções</strong></td>
                            <td>
                                <?= Html::a('<span class="btn btn-warning btn-sm margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i> Atualizar</span>', Url::to(['modalidade/update', 'id' => $model->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                <?=
                                Html::a('<span class="btn btn-danger btn-sm margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</span>', Url::to(['modalidade/delete', 'id' => $model->id]), ['data' => [
                                        'confirm' => Yii::t('app', 'Pretendes apagar esta mensalidade?'),
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