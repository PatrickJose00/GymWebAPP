<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\aulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Aulas');
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
<div class="aula-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Aula</span></h4>', Url::to(['aula/create']), ['title' => 'Adicionar Aula', 'alt' => 'Adicionar Aula']); ?>
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th><?= Yii::t('app', 'Nome') ?></th>
                            <th><?= Yii::t('app', 'Preço') ?></th>
                            <th><?= Yii::t('app', 'Imagem') ?></th>
                            <th><?= Yii::t('app', 'Professor') ?></th>
                            <th><?= Yii::t('app', 'Descrição') ?></th>
                            <th><?= Yii::t('app', 'Opções') ?></th>
                        </tr>
                        <?php
                        $count = 1;
                        if (!empty($aulas)):
                            foreach ($aulas as $aula):
                                ?>
                                <tr>
                                    <td><strong><?= $count++; ?></strong></td>
                                    <td><?= $aula->Nome ?></td>
                                    <td><?= $aula->Preco . '€' ?></td>
                                    <?php if (file_exists(Yii::getAlias('@webroot') . '/aulas/' . $aula->ImageFile)): ?>
                                        <td><?= Html::img(Yii::getAlias('@web') . '/aulas/' . $aula->ImageFile, ['class' => 'img-thumbnail img-aula', 'alt' => $aula->Nome, 'title' => $aula->Nome]); ?></td>
                                    <?php else: ?>
                                        <td><?= Html::img(Yii::getAlias('@web') . '/aulas/no-available.png', ['class' => 'img-thumbnail img-aula', 'alt' => Yii::t('app', 'Imagem não disponível'), 'title' => Yii::t('app', 'Imagem não disponível')]); ?></td>
                                    <?php endif; ?>
                                    <td><?= Html::a($aula->professor->Nome, Url::to(['professor/view', 'id' => $aula->Professor_id])); ?></td>
                                    <td><?= $aula->Descricao ?></td>
                                    <td>
                                        <?= Html::a('<span class="label label-success margin-btn-label"><i class="fa fa-eye" aria-hidden="true"></i></span>', Url::to(['aula/view', 'id' => $aula->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizar')]); ?>
                                        <?= Html::a('<span class="label label-warning margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['aula/update', 'id' => $aula->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                        <?=
                                        Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['aula/delete', 'id' => $aula->id]), ['data' => [
                                                'confirm' => Yii::t('app', 'Pretendes apagar esta aula?'),
                                                'method' => 'post',
                                            ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            echo '<tr><td colspan="6" class="text-center"><strong>-- Sem aulas para mostrar --</strong></td></tr>';
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
