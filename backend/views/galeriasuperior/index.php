<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Imagens');
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
<div class="galeriasuperior-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php elseif (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-check" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Imagem</span></h4>', Url::to(['galeriasuperior/create']), ['title' => 'Adicionar Imagem', 'alt' => 'Adicionar Imagem']); ?>
    <div class="row ">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding" style="overflow-x: visible !important;">
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 20px;">
                            <?php
                            if (!empty($imagensGaleria)):
                                foreach ($imagensGaleria as $imagem):
                                    ?>
                                    <div class="col-lg-3 col-sm-6 col-xs-6">
                                        <div class="thumbnail ">
                                            <?= Html::img(Yii::getAlias('@web') . '/../frontend/web/gallery-top/' . $imagem->Imagem, ['class' => 'center-block imagem-tamanho', 'alt' => $imagem->Nome, 'title' => $imagem->Nome]); ?>
                                            <label><?= $imagem->Nome = ((strlen($imagem->Nome)) >= 25 ? mb_substr($imagem->Nome, 0, 25) . '...' : $imagem->Nome) ?></label>
                                            <div class="pull-right">
                                                <?= Html::a('<span class="btn btn-warning btn-xs margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['galeriasuperior/update', 'id' => $imagem->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                                <?=
                                                Html::a('<span class="btn btn-danger btn-xs margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['galeriasuperior/delete', 'id' => $imagem->id]), ['data' => [
                                                        'confirm' => Yii::t('app', 'Pretende apagar esta imagem?'),
                                                        'method' => 'post',
                                                    ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                                ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <div class="col-md-12 text-center">
                                    <?= Html::img(Yii::getAlias('@web') . '/images/not-found.png', ['class' => 'img-responsive center-block mb-40']) ?>
                                    <label>-- Sem imagens para mostrar --</label>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>
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
    <div class="clearfix"></div>
</div>