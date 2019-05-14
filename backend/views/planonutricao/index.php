<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\aulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Alimentos');
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
<div class="planonutricao-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="planoexercicio-index">
        <div class="row">
            <div class="col-xs-12">
                <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Alimento ao Plano</span></h4>', Url::to(['planonutricao/create']), ['title' => 'Adicionar Exercício ao Plano', 'alt' => 'Adicionar Exercício ao Plano']); ?>
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center"><?= Yii::t('app', 'Dia'); ?></th>
                                <th class="text-center"><?= Yii::t('app', 'Horário'); ?></th>
                                <th class="text-center"><?= Yii::t('app', 'Categoria'); ?></th>
                                <th class="text-center"><?= Yii::t('app', 'Alimento(s)'); ?></th>
                                <th class="text-center"><?= Yii::t('app', 'Peso'); ?></th>
                                <th class="text-center"><?= Yii::t('app', 'Opções'); ?></th>
                            </tr>
                            <?php
                            $count = 0;
                            if (!empty($planoNutricao)):
                                foreach ($planoNutricao as $plano):
                                    ?>
                                    <tr>
                                        <?php
                                        $gerarPdf = '';
                                        if (!empty($plano->alimetoPlanoRefeicaos)):
                                            $gerarPdf = Html::a('<span class="pull-left" data-toggle="tooltip" title="Gerar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>', ['planonutricao/criar-pdf', 'id' => $plano->id]);
                                        endif;
                                        ?>
                                        <td colspan="7" class="text-center primary"><?= $gerarPdf ?><b><?= $plano->Nome ?></b></td>
                                    </tr>
                                    <?php if (!empty($plano->alimetoPlanoRefeicaos)): ?>
                                        <?php foreach ($plano->alimetoPlanoRefeicaos as $value): ?>
                                            <?php
                                            switch ($value->Dia):
                                                case "1":
                                                    $value->Dia = "Segunda";
                                                    break;
                                                case "2":
                                                    $value->Dia = "Terça";
                                                    break;
                                                case "3":
                                                    $value->Dia = "Quarta";
                                                    break;
                                                case "4":
                                                    $value->Dia = "Quinta";
                                                    break;
                                                case "5":
                                                    $value->Dia = "Sexta";
                                                    break;
                                                case "6":
                                                    $value->Dia = "Sábado";
                                                    break;
                                                case "7":
                                                    $value->Dia = "Domingo";
                                                    break;
                                            endswitch;
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= ++$count; ?></td>
                                                <td class="text-center"><?= $value->Dia ?></td>
                                                <td class="text-center">
                                                    <ul>
                                                        <?php foreach ($value->alimetoPlanoRefeicaoHasRefeicaos as $refeicao):
                                                            ?>
                                                            <li><?= $refeicao->refeicao->Hora . ':00h' ?></li>
                                                            <?php
                                                        endforeach;
                                                        ?>
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    <ul>
                                                        <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                                            <li><?= $alimentos->alimento->categoriaAlimentos->Nome ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    <ul>
                                                        <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                                            <li>  <?= $alimentos->alimento->Nome ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    <ul>
                                                        <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                                            <li><?= $alimentos->Peso . 'g' ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    <?= Html::a('<span class="label label-success margin-btn-label"><i class="fa fa-eye" aria-hidden="true"></i></span>', Url::to(['planonutricao/view', 'id' => $value->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizar')]); ?>
                                                    <?= Html::a('<span class="label label-warning margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['planonutricao/update', 'id' => $value->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                                    <?=
                                                    Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['planonutricao/delete', 'id' => $value->id]), ['data' => [
                                                            'confirm' => Yii::t('app', 'Pretendes apagar este alimento?'),
                                                            'method' => 'post',
                                                        ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Este Plano encontra-se vazio</td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center success"><b>-- Sem dados para mostrar --</b></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
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


