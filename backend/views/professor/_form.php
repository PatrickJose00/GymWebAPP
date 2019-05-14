<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Professor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="professor-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar um novo Professor</h3>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <?php
            if (!$model->isNewRecord) {
                echo Html::img(Yii::getAlias('@web') . '/professores/' . $model->Foto, ['class' => 'img-thumbnail', 'width' => '100', 'alt' => $model->Nome, 'title' => $model->Nome]);
            }
            ?>
            <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Rodrigo Mendes')]) ?>

            <?= $form->field($model, 'Email', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'rodrig.mendes@gmail.com')]) ?>
            <?= $form->field($model, 'BI', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '12402730')]) ?>
            <?= $form->field($model, 'Contribuinte', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '267584123')]) ?>
            <?=
            $form->field($model, 'DataNascimento')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '05/08/1985'],
                'pluginOptions' => [
                    'language' => 'pt',
                    'format' => 'mm/dd/yyyy',
                    'autoclose' => true
                ]
            ]);
            ?>
            <?= $form->field($model, 'Foto', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->fileInput(['accept' => 'image/*']) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar Professor') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
