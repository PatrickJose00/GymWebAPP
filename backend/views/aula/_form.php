<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Professor;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar uma nova Aula</h3>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Kickbox')]) ?>

            <?= $form->field($model, 'Descricao', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textarea(['rows' => '4', 'maxlength' => true, 'placeholder' => Yii::t('app', 'Esta aula está no TOP de queima-calorias! A aula é dividida em 3 fases: aquecimento, treino ou fase principal e retorno à calma/alongamento.')]) ?>

            <?= $form->field($model, 'Professor_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Professor::find()->all(), 'id', 'Nome'), ['prompt' => Yii::t('app', '-- Selecione o Professor --')]) ?>

            <?= $form->field($model, 'Preco', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '20.00')]) ?>

            <?= $form->field($model, 'ImageFile', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->fileInput(['accept' => 'image/*']) ?>
            <?php
            if (!$model->isNewRecord) {
                if (file_exists(Yii::getAlias('@webroot') . '/aulas/' . $model->ImageFile)) {
                    echo Html::img(Yii::getAlias('@web') . '/aulas/' . $model->ImageFile, ['class' => 'img-thumbnail', 'width' => '200', 'alt' => $model->Nome, 'title' => $model->Nome]);
                } else {
                    echo Html::img(Yii::getAlias('@web') . '/aulas/no-available.png', ['class' => 'img-thumbnail', 'width' => '200', 'alt' => Yii::t('app', 'Imagem não disponível'), 'title' => Yii::t('app', 'Imagem não disponível')]);
                }
            }
            ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar Aula') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>