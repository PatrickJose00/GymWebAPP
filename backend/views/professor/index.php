<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfessorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Professores');
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
<div class="professor-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Professor</span></h4>', Url::to(['professor/create']), ['title' => 'Adicionar Professor', 'alt' => 'Adicionar Professor']); ?>
            <div class="box">
                <div class="box-body table-responsive no-padding" style="overflow-x: visible !important;">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th><?= Yii::t('app', 'Foto') ?></th>
                            <th><?= Yii::t('app', 'Nome') ?></th>
                            <th><?= Yii::t('app', 'Email') ?></th>
                            <th><?= Yii::t('app', 'Aula(s)') ?></th>
                            <th><?= Yii::t('app', 'Data de Nascimento') ?></th>
                            <th><?= Yii::t('app', 'Opções') ?></th>
                        </tr>
                        <?php
                        $count = 1;
                        if (!empty($professores)):
                            foreach ($professores as $professor):
                                ?>
                                <tr>
                                    <td><strong><?= $count++; ?></strong></td>
                                    <td><?= Html::img(Yii::getAlias('@web') . '/professores/' . $professor->Foto, ['class' => 'img-thumbnail img-aula center-block', 'alt' => $professor->Nome, 'title' => $professor->Nome]); ?></td>
                                    <td><?= $professor->Nome ?></td>
                                    <td><?= $professor->Email ?></td>
                                    <td>
                                        <?php
                                        if (!empty($professor->aulas)):
                                            echo '<ul>';
                                            foreach ($professor->aulas as $aula):
                                                ?>
                                        <li><?= Html::a($aula->Nome, Url::to(['aula/view', 'id' => $aula->id]), ['target' => '_blank']); ?></li>
                                        <?php
                                    endforeach;
                                    echo '</ul>';
                                else:
                                    echo '<span>--Sem aulas--</span>';
                                endif;
                                ?>
                                </ul>
                                </td>
                                <td><?= date('d-M-Y', $professor->DataNascimento) ?></td>
                                <td>
                                    <?= Html::a('<span class="label label-success margin-btn-label"><i class="fa fa-eye" aria-hidden="true"></i></span>', Url::to(['professor/view', 'id' => $professor->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizar')]); ?>
                                    <?= Html::a('<span class="label label-warning margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['professor/update', 'id' => $professor->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                    <?=
                                    Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['professor/delete', 'id' => $professor->id]), ['data' => [
                                            'confirm' => Yii::t('app', 'Pretendes apagar este professor?'),
                                            'method' => 'post',
                                        ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                    ?>
                                </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            echo '<tr><td colspan="6" class="text-center"><strong>-- Sem professores para mostrar --</strong></td></tr>';
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
