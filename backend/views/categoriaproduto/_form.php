<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categoriaproduto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoriaproduto-form">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Adicionar Categoria</h3>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="box-body">
                    <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => 'Proteína'])->label(Yii::t('app', 'Categoria'), ['for' => 'categoriaproduto-nome']) ?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar Categoria') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>  
</div>
