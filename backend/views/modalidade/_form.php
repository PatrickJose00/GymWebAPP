<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Pack */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modalidade-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar uma nova Mensalidade</h3>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?= $form->field($model, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Pack Exemplo')]) ?>
            <?= $form->field($model, 'Descricao', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textarea(['rows' => 5, 'maxlength' => true, 'placeholder' => Yii::t('app', 'detalhe 1, detalhe 2 (separado por ,)')]) ?>
            <?= $form->field($model, 'NumeroEntradas', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '5 (0 para ilimitado)')]) ?>
            <?= $form->field($model, 'Preco', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '20.00')]) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar Modalidade') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
