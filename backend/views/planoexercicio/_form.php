<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categoriaexercicio;
use backend\models\Exercicio;
use backend\models\PlanoDeTreino;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */
/* @var $form yii\widgets\ActiveForm */
$path = Yii::getAlias('@web');
$this->registerJsFile($path . "/js/script.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="planoexercicio-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar uma novo Exercício</h3>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <?php
            $dias = ['1' => 'Segunda-Feira', '2' => 'Terça-Feira', '3' => 'Quarta-Feira', '4' => 'Quinta-Feira', '5' => 'Sexta-Feira', '6' => 'Sábado', '7' => 'Domingo']
            ?>
            <?=
            $form->field($exercicioPlano, 'Dia', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList($dias);
            ?>
            <?=
            $form->field($exercicioPlano, 'Plano_de_Treino_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(PlanoDeTreino::find()->all(), 'id', 'Nome'), [
                'prompt' => Yii::t('app', '-- Selecione o Plano --')]);
            ?>
            <?=
            $form->field($exercicio, 'CategoriaExercicio_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Categoriaexercicio::find()->all(), 'id', 'Nome'), [
                'prompt' => Yii::t('app', '-- Selecione a Categoria --'),
            ])
            ?>
            <?php if ($exercicioPlano->isNewRecord): ?>
                <?= $form->field($exercicioPlano, 'Exercicios_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList([], ['prompt' => Yii::t('app', '-- Selecione o Exercício --')]) ?>
            <?php else: ?>
                <?= $form->field($exercicioPlano, 'Exercicios_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Exercicio::find()->all(), 'id', 'Nome'), ['prompt' => Yii::t('app', '-- Selecione o Exercício --')]) ?>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-12" id="display-image">
                    <?php if (!$exercicioPlano->isNewRecord): ?>
                        <div id="mostrar-imagem"><?= Html::img(Yii::getAlias('@web') . '/exercicios/' . $exercicio->Foto, ['height' => '300', 'width' => '300', 'title' => $exercicio->Nome, 'alt' => $exercicio->Nome]); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <?= $form->field($exercicioPlano, 'Repeticoes', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['type' => 'number', 'min' => 1, 'maxlength' => true, 'placeholder' => Yii::t('app', '15')]); ?>
                </div>
                <div class="col-md-1">
                    <?= $form->field($exercicioPlano, 'Carga', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['type' => 'number', 'min' => 1, 'maxlength' => true, 'placeholder' => Yii::t('app', '25')]); ?>
                </div>
                <div class="col-md-1">
                    <?= $form->field($exercicioPlano, 'Pausa', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['type' => 'number', 'min' => 1, 'maxlength' => true, 'placeholder' => Yii::t('app', '30')]); ?>
                </div>
                <div class="col-md-1">
                    <?= $form->field($exercicioPlano, 'Series', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['type' => 'number', 'min' => 1, 'maxlength' => true, 'placeholder' => Yii::t('app', '3')]); ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($exercicioPlano->isNewRecord ? Yii::t('app', 'Adicionar Exercício') : Yii::t('app', 'Atualizar'), ['class' => $exercicioPlano->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>