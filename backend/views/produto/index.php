<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProdutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listagem de Produtos');
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
$this->registerJsFile(Yii::getAlias('@web') . '/js/nav.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="produto-index">
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
    <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Produto</span></h4>', Url::to(['produto/create']), ['title' => 'Adicionar Produto', 'alt' => 'Adicionar Produto']); ?>
    <div class="row equal">
        <div class="col-md-2">
            <div class="box same-height">
                <h4 class="text-center"><strong>Categorias</strong></h4>
                <hr>
                <div id="w">
                    <nav>
                        <ul id="nav">
                            <li><a href="<?= Url::to(['produto/index']); ?>">Mostrar tudo</a></li>
                            <?php foreach ($categorias as $categoria): ?>
                                <li><a href="javascript:void(0);"><?= $categoria->Nome ?></a>
                                    <ul>
                                        <?php foreach ($categoria->subcategoriaprodutos as $subcategoria): ?>
                                            <li>
                                                <a href="<?= Url::to(['produto/index', 'sub' => $subcategoria->id]); ?>"><?= $subcategoria->Nome ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="box">
                <div class="box-body table-responsive no-padding" style="overflow-x: visible !important;">
                    <div class="row">
                        <div class="col-md-12" style="padding-top: 20px;">
                            <?php
                            if (!empty($produtos)):
                                foreach ($produtos as $produto):
                                    ?>
                                    <div class="col-lg-3 col-sm-6 col-xs-6">
                                        <div class="thumbnail">
                                            <?php $imagemProduto = Html::img(Yii::getAlias('@web') . '/../frontend/web/produtos/' . $produto->Imagem, ['alt' => $produto->Nome, 'title' => $produto->Nome, 'class' => 'center-block']); ?>
                                            <?= Html::a($imagemProduto, ['produto/view', 'id' => $produto->id]); ?>
                                            <label><?= $produto->Nome = ((strlen($produto->Nome)) >= 25 ? mb_substr($produto->Nome, 0, 25) . '...' : $produto->Nome) ?></label>
                                            <p><?= $produto->Descricao = ((strlen($produto->Descricao)) >= 70 ? mb_substr($produto->Descricao, 0, 70) . '...' : $produto->Descricao) ?></p>
                                            <div class="pull-right">
                                                <?= Html::a('<span class="btn btn-warning btn-xs margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['produto/update', 'id' => $produto->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                                <?=
                                                Html::a('<span class="btn btn-danger btn-xs margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['produto/delete', 'id' => $produto->id]), ['data' => [
                                                        'confirm' => Yii::t('app', 'Pretendes apagar este produto?'),
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
                                    <label>-- Sem produtos para mostrar --</label>
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