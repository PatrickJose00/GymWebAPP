<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="criar-planon-form">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Adicionar Plano Nutrição</h3>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="box-body">
                    <?= $form->field($planoNutricao, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => 'Comida Saudável'])->label(Yii::t('app', 'Nome'), ['for' => 'planodetreino-nome']) ?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton($planoNutricao->isNewRecord ? Yii::t('app', 'Criar Plano') : Yii::t('app', 'Atualizar'), ['class' => $planoNutricao->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>  
</div>
