<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Mensalidades');
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
<div class="modalidade-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Mensalidade</span></h4>', Url::to(['modalidade/create']), ['title' => 'Adicionar Modalidade', 'alt' => 'Adicionar Modalidade']); ?>
            <div class="box">
                <div class="box-body table-responsive no-padding" style="overflow-x: visible !important;">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th class="text-center"><?= Yii::t('app', 'Nome') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Detalhes') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Entradas') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Preço') ?></th>
                            <th class="text-center"><?= Yii::t('app', 'Opções') ?></th>
                        </tr>
                        <?php
                        $count = 1;
                        if (!empty($modalidades)):
                            foreach ($modalidades as $modalidade):
                                ?>
                                <tr>
                                    <td><strong><?= $count++; ?></strong></td>
                                    <td class="text-center"><?= $modalidade->Nome ?></td>
                                    <td><?php
                                        if (!empty($modalidade->Descricao)) {
                                            $descricoes = explode(',', $modalidade->Descricao);
                                            echo '<ul class="ul-bullet">';
                                            foreach ($descricoes as $descricao) {
                                                echo '<li>' . $descricao . '</li>';
                                            }
                                            echo '</ul>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><?= $modalidade->NumeroEntradas == 0 ? "Ilimitado" : $modalidade->NumeroEntradas ?></td>
                                    <td class="text-center"><?= $modalidade->Preco . '€' ?></td>
                                    <td class="text-center">
                                        <?= Html::a('<span class="label label-success margin-btn-label"><i class="fa fa-eye" aria-hidden="true"></i></span>', Url::to(['modalidade/view', 'id' => $modalidade->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizar')]); ?>
                                        <?= Html::a('<span class="label label-warning margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['modalidade/update', 'id' => $modalidade->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                        <?=
                                        Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['modalidade/delete', 'id' => $modalidade->id]), ['data' => [
                                                'confirm' => Yii::t('app', 'Pretendes apagar esta mensalidade?'),
                                                'method' => 'post',
                                            ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            echo '<tr><td colspan="6" class="text-center"><strong>-- Sem mensalidades para mostrar --</strong></td></tr>';
                        endif;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?=
    LinkPager::widget([
        'pagination' => $pages,
        'maxButtonCount' => 4,
        'lastPageLabel' => '»»',
        'firstPageLabel' => '««',
        'options' => ['class' => 'pagination pull-right']
    ])
    ?>
</div>
