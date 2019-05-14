<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Planodenutricao;
use backend\models\Refeicao;
use backend\models\Alimento;
use backend\models\Categoriaalimento;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */
/* @var $form yii\widgets\ActiveForm */
$path = Yii::getAlias('@web');
$this->registerJsFile($path . "/js/script.js", ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="planoexercicio-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Adicionar uma novo Alimento</h3>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="box-body">
            <?php
            $dias = ['1' => 'Segunda-Feira', '2' => 'Terça-Feira', '3' => 'Quarta-Feira', '4' => 'Quinta-Feira', '5' => 'Sexta-Feira', '6' => 'Sábado', '7' => 'Domingo']
            ?>
            <?=
            $form->field($alimentoPlanoRefeicao, 'Dia', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList($dias);
            ?>
            <?=
            $form->field($alimentoPlanoRefeicao, 'PlanosdeNutricao_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Planodenutricao::find()->all(), 'id', 'Nome'), [
                'prompt' => Yii::t('app', '-- Selecione o Plano --')]);
            ?>
            <?php if ($alimentoPlanoRefeicao->isNewRecord) : ?>
                <?=
                $form->field($planoHasRefeicao, 'Refeicao_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Refeicao::find()->all(), 'id', 'Hora'), ['size' => 5, 'multiple' => 'multiple'])
                ?>
                <?=
                $form->field($alimentoHasPlanoRefeicao, 'Alimento_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(Categoriaalimento::getHierarchy(), ['size' => 10, 'multiple' => 'multiple'], ['prompt' => Yii::t('app', '-- Selecione o Alimento --'),
                ])
                ?>
            <?php else: ?>
                <?php $planoHasRefeicao[0]->Refeicao_id = $horarios; ?>
                <?=
                $form->field($planoHasRefeicao[0], 'Refeicao_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Refeicao::find()->all(), 'id', 'Hora'), ['size' => 5, 'multiple' => 'multiple'])
                ?>
                <?php $alimentoHasPlanoRefeicao[0]->Alimento_id = $alimentos; ?>
                <?=
                $form->field($alimentoHasPlanoRefeicao[0], 'Alimento_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(Categoriaalimento::getHierarchy(), ['size' => 10, 'multiple' => 'multiple'], ['prompt' => Yii::t('app', '-- Selecione o Alimento --'),
                ])
                ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <?php if ($alimentoPlanoRefeicao->isNewRecord) : ?>
                        <?= $form->field($alimentoHasPlanoRefeicao, 'Peso', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['placeholder' => Yii::t('app', '45,33,23')]); ?>
                    <?php else: ?>
                    <?php $alimentoHasPlanoRefeicao[0]->Peso = $pesos; ?>
                        <?= $form->field($alimentoHasPlanoRefeicao[0], 'Peso', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['placeholder' => Yii::t('app', '45,33,23')]); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($alimentoPlanoRefeicao->isNewRecord ? Yii::t('app', 'Adicionar Alimento') : Yii::t('app', 'Atualizar'), ['class' => $alimentoPlanoRefeicao->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>