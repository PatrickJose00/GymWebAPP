<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Produto */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Produtos'), 'url' => ['index']];
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
<div class="produto-view">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">Detalhes do Produto</div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <img class="img-responsive" src="<?= '../../frontend/web/produtos/' . $model->Imagem ?>" alt="<?= $model->Nome ?>" title="<?= $model->Nome ?> "/>
                                </div>
                                <div class="col-md-9">
                                    <h2><?= $model->Nome ?></h2>
                                    <label><?= $model->subCategoriaProduto->categoriaProdutos->Nome . ' / ' . $model->subCategoriaProduto->Nome ?></label>
                                    <p>
                                        <?= $model->Descricao ?>
                                    </p>
                                    <div class="text-left">
                                        <label>Preço:</label> <span class="itemPrice"><?= $model->Preco . '€' ?></span>
                                    </div>
                                    <div class="pull-right">
                                        <?= Html::a('<span class="btn btn-warning btn-sm margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i> Atualizar</span>', Url::to(['produto/update', 'id' => $model->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                        <?=
                                        Html::a('<span class="btn btn-danger btn-sm margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</span>', Url::to(['produto/delete', 'id' => $model->id]), ['data' => [
                                                'confirm' => Yii::t('app', 'Pretendes apagar este produto?'),
                                                'method' => 'post',
                                            ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
