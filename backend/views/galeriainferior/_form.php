<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Galeriagym */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galeriasuperior-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar uma nova Imagem</h3>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <?php
            if (!$model->isNewRecord) {
                echo Html::img(Yii::getAlias('@web') . '/../frontend/web/gallery-inside/' . $model->Imagem, ['class' => 'img-thumbnail', 'width' => '250', 'alt' => $model->Nome, 'title' => $model->Nome]);
            }
            ?>
            <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Piscina Exterior')]) ?>
            <?= $form->field($model, 'Imagem', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->fileInput(['accept' => 'image/*']) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Adicionar') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
