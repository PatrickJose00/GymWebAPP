<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfessorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Mensalidades Antigas');
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
                            <th><?= Yii::t('app', 'Pack') ?></th>
                            <th><?= Yii::t('app', 'Preço') ?></th>
                            <th><?= Yii::t('app', 'Data Inscrição') ?></th>
                        </tr>
                        <?php
                        $count = 1;
                        if (!empty($registos)):
                            $count = 1;
                            foreach ($registos as $registo):
                                if (!empty($registo->mensalidades)):
                                    foreach ($registo->mensalidades as $mensalidade):
                                        ?>
                                        <tr>
                                            <td><?= $count++; ?></td>
                                            <td><?= $mensalidade->pack->Nome ?></td>
                                            <td><?= $mensalidade->Preco . '€' ?></td>
                                            <td><?= date('d-M-Y', $registo->Data) ?></td>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                            endforeach;
                            ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">-- Sem mensalidades antigas--</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
//    LinkPager::widget([
//        'pagination' => $pages,
//        'maxButtonCount' => 4,
//        'lastPageLabel' => '»»',
//        'firstPageLabel' => '««',
//        'options' => ['class' => 'pagination pull-right']
//    ])
    ?>
</div>
