<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
$js = <<<JS
        $('#mapa').locationpicker({
            location: {
                latitude: $lat,
                longitude: $long,
            },
            radius: 0,
            inputBinding: {
                latitudeInput: $('#mapa-lat'),
                longitudeInput: $('#mapa-lon'),
                radiusInput: $('#mapa-radius'),
                locationNameInput: $('#mapa-address')
            },
            enableAutocomplete: true,
        });
JS;
$this->registerJs($js);
?>

<div class="cliente-form">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Dados do Cliente</h3>
        </div>

        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?= $form->field($user, 'username', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => '13652'])->label(Yii::t('app', 'Número de Cliente'), ['for' => 'user-username']) ?>
            <?= $form->field($cliente, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Rui dos Santos Costa')])->label(null, ['for' => 'cliente-nome']) ?>
            <?= $form->field($user, 'email', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => 'rui.santos@gmail.com'])->label(Yii::t('app', 'Email do Cliente'), ['for' => 'user-email']) ?>
            <?= $form->field($cliente, 'Genero', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(['0' => 'Masculino', '1' => 'Feminino', '2' => 'Outro'])->label(Yii::t('app', 'Género'), ['for' => 'user-genero']) ?>
            <?=
            $form->field($cliente, 'DataNascimento')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '05/08/1985'],
                'pluginOptions' => [
                    'language' => 'pt',
                    'format' => 'mm/dd/yyyy',
                    'autoclose' => true
                ]
            ]);
            ?>
            <?= $form->field($cliente, 'BI', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '13695595')])->label(null, ['for' => 'cliente-bi']) ?>
            <?= $form->field($cliente, 'Contribuinte', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '214569875')])->label(null, ['for' => 'cliente-contribuinte']) ?>
            <?= $form->field($cliente, 'Telefone', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', '234875695')])->label(null, ['for' => 'cliente-telefone']) ?>
            <div id="mapa" style="width: 100%; height: 400px;"></div>
            <div class="clearfix">&nbsp;</div>
            <?= $form->field($morada, 'Endereco', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'placeholder' => 'Praça Marquês de Pombal 3b, Póvoa de Varzim, Portugal', 'id' => 'mapa-address']); ?>
            <?= $form->field($morada, 'Latitude', ['template' => "{input}", 'options' => ['tag' => null]])->hiddenInput(['id' => 'mapa-lat'])->label(false); ?>
            <?= $form->field($morada, 'Longitude', ['template' => "{input}", 'options' => ['tag' => null]])->hiddenInput(['id' => 'mapa-lon'])->label(false); ?>
            <!--                <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Check me out
                                </label>
                            </div>-->
        </div>
        <div class="box-footer">
            <?= Html::submitButton($cliente->isNewRecord ? Yii::t('app', 'Efetuar Registo') : Yii::t('app', 'Atualizar'), ['class' => $cliente->isNewRecord ? 'btn btn-primary' : 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>