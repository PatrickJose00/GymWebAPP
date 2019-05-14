<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\PlanoDeTreino;

$this->title = Yii::t('app', 'Atribuir Plano Exercício');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="categoriaproduto-form">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title pull-right"><?=Html::a('Histórico de Planos', ['cliente/historico-planos', 'id' => $cliente_id], ['style' => 'font-size: 12px;'])?></h3>
                </div>
                <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
                <div class="box-body">
                    <?= $form->field($planoCliente, 'Plano_de_Treino_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(PlanoDeTreino::find()->asArray()->all(), 'id', 'Nome'))->label(Yii::t('app', 'Plano'), ['for' => 'planotreinocliente-plano_de_treino_id']) ?>
                    <?php if (!empty($planoAtual)): ?>
                        <label>Plano Atual: </label> <span><?= $planoAtual->planosDeTreino->Nome ?></span>
                    <?php endif; ?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton($planoCliente->isNewRecord ? Yii::t('app', 'Atribuir Plano') : Yii::t('app', 'Atualizar'), ['class' => $planoCliente->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div> 
</div>
