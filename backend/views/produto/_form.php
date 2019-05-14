<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Categoriaproduto;
/* @var $this yii\web\View */
/* @var $model backend\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar um novo Produto</h3>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <?php
            if (!$model->isNewRecord) {
                echo Html::img('../../frontend/web/produtos/' . $model->Imagem, ['class' => 'img-thumbnail', 'width' => '100', 'alt' => $model->Nome, 'title' => $model->Nome]);
            }
            ?>
            <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '100% Real Whey Protein 1250 g'), 'for' => 'produto-nome']) ?>
            <?= $form->field($model, 'Descricao', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textarea(['rows' => 6, 'maxlength' => true, 'placeholder' => Yii::t('app', 'Proteína whey da mais alta qualidade..'), 'for' => 'produto-descricao']) ?>
            <?= $form->field($model, 'Preco', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => '44.99€', 'for' => 'produto-preco']) ?>
            <?= $form->field($model, 'SubCategoriaProduto_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(Categoriaproduto::getHierarchy(), ['size' => 10]) ?>
            <?= $form->field($model, 'Imagem', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->fileInput(['accept' => 'image/*']) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Adicionar Produto') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>