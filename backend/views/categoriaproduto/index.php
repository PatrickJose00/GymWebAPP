<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoriaprodutoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categoria');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoriaproduto-index">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <?= Html::a('<h4><span class="btn btn-success margin-btn-add"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Categoria</span></h4>', Url::to(['categoriaproduto/create']), ['title' => 'Adicionar Categoria', 'alt' => 'Adicionar Categoria']); ?>
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover box-title">
                        <tr>
                            <th>#</th>
                            <th><?= Yii::t('app', 'Categoria') ?></th>
                            <th><?= Yii::t('app', 'Subcategoria') ?></th>
                            <th><?= Yii::t('app', 'Opções') ?></th>
                        </tr>
                        <?php
                        $count = 1;
                        ?>
                        <?php
                        if (!empty($categorias)):
                            foreach ($categorias as $categoria):
                                ?>
                                <tr>
                                    <td><strong><?= $count++; ?></strong></td>
                                    <td><?= $categoria->Nome ?></td>
                                    <td>
                                        <ul>
                                            <?php
                                            foreach ($categoria->subcategoriaprodutos as $subCategoria):
                                                echo '<li>' . Html::a($subCategoria->Nome, Url::to(['subcategoriaproduto/view', 'id' => $subCategoria->id])) . '</li>';
                                            endforeach;
                                            ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <?= Html::a('<span class="label label-success margin-btn-label"><i class="fa fa-eye" aria-hidden="true"></i></span>', Url::to(['categoriaproduto/view', 'id' => $categoria->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizar')]); ?>
                                        <?= Html::a('<span class="label label-warning margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i></span>', Url::to(['categoriaproduto/update', 'id' => $categoria->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                        <?=
                                        Html::a('<span class="label label-danger margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i></span>', Url::to(['categoriaproduto/delete', 'id' => $categoria->id]), ['data' => [
                                                'confirm' => Yii::t('app', 'Pretendes apagar esta categoria?'),
                                                'method' => 'post',
                                            ], 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Apagar')]);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <tr><td colspan="6" class="text-center"><strong>-- Sem categorias para mostrar --</strong></td></tr>
                        <?php
                        endif;
                        ?>
                    </table>
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
</div>
