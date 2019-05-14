<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categoriaproduto;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategoriaproduto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategoriaproduto-form">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Adicionar Subcategoria</h3>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="box-body">
                    <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => 'Whey'])->label(Yii::t('app', 'Subcategoria'), ['for' => 'subcategoriaproduto-nome']) ?>
                    <?= $form->field($model, 'CategoriaProdutos_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Categoriaproduto::find()->all(), 'id', 'Nome'), ['prompt' => Yii::t('app', '-- Selecione a Categoria --')]) ?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar Subcategoria') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
