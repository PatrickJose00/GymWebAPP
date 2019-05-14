<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Aulas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->Nome;
$js=<<<JS
window.setTimeout(function() {
    $(".alert-slide").fadeTo(800, 0).slideUp(600, function(){
        $(this).remove(); 
        });
    }, 5000);
;
JS;
$this->registerJs($js);
?>
<div class="aula-view">
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
                    <h3 class="box-title">Detalhes de <u><?= $model->Nome ?></u>:</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Nome'); ?></strong></td>
                            <td><?= $model->Nome ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Preco'); ?></strong></td>
                            <td><?= $model->Preco . '€' ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= Yii::t('app', 'Professor') ?></strong></td>
                            <td><?= Html::a($model->professor->Nome, Url::to(['professor/view', 'id' => $model->Professor_id])); ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('Descricao'); ?></strong></td>
                            <td><?= $model->Descricao ?></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong><?= $model->getAttributeLabel('ImageFile'); ?></strong></td>
                            <?php if (file_exists(Yii::getAlias('@webroot') . '/aulas/' . $model->ImageFile)): ?>
                                <td><?= Html::img(Yii::getAlias('@web') . '/aulas/' . $model->ImageFile, ['class' => 'img-thumbnail', 'width' => 400, 'alt' => $model->Nome, 'title' => $model->Nome]); ?></td>
                            <?php else: ?>
                                <td><?= Html::img(Yii::getAlias('@web') . '/aulas/no-available.png', ['class' => 'img-thumbnail', 'width' => 400, 'alt' => Yii::t('app', 'Imagem não disponível'), 'title' => Yii::t('app', 'Imagem não disponível')]); ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Opções</strong></td>
                            <td>
                                <?= Html::a('<span class="btn btn-warning btn-sm margin-btn-label"><i class="fa fa-pencil" aria-hidden="true"></i> Atualizar</span>', Url::to(['aula/update', 'id' => $model->id]), ['data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Atualizar')]); ?>
                                <?=
                                Html::a('<span class="btn btn-danger btn-sm margin-btn-label"><i class="fa fa-trash" aria-hidden="true"></i> Apagar</span>', Url::to(['aula/delete', 'id' => $model->id]), ['data' => [
                                        'confirm' => Yii::t('app', 'Pretendes apagar esta aula?'),
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
