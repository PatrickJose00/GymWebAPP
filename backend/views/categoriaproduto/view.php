<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Categoriaproduto */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Categorias'), 'url' => ['index']];
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
<div class="categoriaproduto-view">
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
                    <h3 class="box-title">Categoria <u><?= $model->Nome ?></u>:</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Nome'); ?></strong></td>
                            <td><?= $model->Nome ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Subcategoria(s)') ?></strong></td>
                            <td>
                                <?php if (!empty($model->subcategoriaprodutos)): ?>
                                    <ul class="ul-bottom">
                                        <?php
                                        foreach ($model->subcategoriaprodutos as $subCategoria):
                                            echo '<li>' . $subCategoria->Nome . '</li>';
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php else: ?>
                                    <span>-- Sem subcategoria --</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Opções</strong></td>
                            <td>
                                <?= Html::a('<span class="btn btn-warning btn-sm margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i> Atualizar</span>', Url::to(['categoriaproduto/update', 'id' => $model->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                <?=
                                Html::a('<span class="btn btn-danger btn-sm margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</span>', Url::to(['categoriaproduto/delete', 'id' => $model->id]), ['data' => [
                                        'confirm' => Yii::t('app', 'Pretendes apagar esta sala?'),
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
