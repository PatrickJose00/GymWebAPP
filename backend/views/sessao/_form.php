<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Sala;
use backend\models\Aula;
use backend\models\Professor;
use kartik\datetime\DateTimePicker;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adicionar-sessao-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Dados a Preencher</h3>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2">
                    <?=
                    $form->field($sessao, 'PrimeiraSessao')->widget(DateTimePicker::classname(), [
                        'options' => ['placeholder' => Yii::t('app', 'Primeira sessão')],
                        'pluginOptions' => [
                            'language' => 'pt',
                            'autoclose' => true
                        ]
                    ])
                    ?>
                </div>
                <div class="col-md-2">
                    <?=
                    $form->field($sessao, 'SegundaSessao')->widget(DateTimePicker::classname(), [
                        'options' => ['placeholder' => Yii::t('app', 'Segunda sessão')],
                        'pluginOptions' => [
                            'language' => 'pt',
                            'autoclose' => true
                        ]
                    ])
                    ?>
                </div>
                <div class="col-md-1">
                    <?=
                    $form->field($sessao, 'Duracao')->widget(TimePicker::classname(), [
                        'pluginOptions' => [
                            'language' => 'pt',
                            'showMeridian' => false,
                            'minuteStep' => 1,
                            'secondStep' => 5,
                            'defaultTime' => '02:00',
                        ]
                    ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <?= $form->field($sessao, 'Sala_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Sala::find()->all(), 'id', 'Nome'), ['prompt' => '-- Sala --'])->label(null, ['for' => 'sessao-sala_id']) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($sessao, 'Aula_id', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(ArrayHelper::map(Aula::find()->all(), 'id', 'Nome'), ['prompt' => '-- Aula --'])->label(null, ['for' => 'sessao-aula_id']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <?= $form->field($sessao, 'Descricao', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textarea(['maxlength' => true, 'rows' => '5', 'placeholder' => Yii::t('app', 'Detalhes importantes..')])->label(null, ['for' => 'sessao-descricao']) ?>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <?= Html::submitButton($sessao->isNewRecord ? Yii::t('app', 'Adicionar Sessão') : Yii::t('app', 'Atualizar'), ['class' => $sessao->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>