<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sala-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar uma nova Sala</h3>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Sala 30A')]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'Lotacao', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => '35']) ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar Sala') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
