<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SalaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem Planos de Treino');
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
<div class="sala-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-2">
            <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Plano</span></h4>', Url::to(['plano/create']), ['title' => 'Adicionar Plano', 'alt' => 'Adicionar Plano']); ?>
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th><?= Yii::t('app', 'Nome') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Opções') ?></th>
                        </tr>
                        <?php
                        $count = 1;
                        if (!empty($planosTreino)):
                            foreach ($planosTreino as $planoTreino):
                                ?>
                                <tr>
                                    <td><strong><?= $count++; ?></strong></td>
                                    <td><?= $planoTreino->Nome ?></td>
                                    <td class="text-center">
                                        <?= Html::a('<span class="label label-warning margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['plano/update', 'id' => $planoTreino->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                        <?=
                                        Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['plano/delete', 'id' => $planoTreino->id]), ['data' => [
                                                'confirm' => Yii::t('app', 'Pretende apagar este plano?'),
                                                'method' => 'post',
                                            ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            echo '<tr><td colspan="6" class="text-center"><strong>-- Sem planos para mostrar --</strong></td></tr>';
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
