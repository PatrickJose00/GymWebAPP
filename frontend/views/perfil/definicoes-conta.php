<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$this->title = "Definições da conta";
$this->params['user'] = $user;
$this->params['mensalidadeAtual'] = $mensalidadeAtual;
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
<div class="definicoes-conta">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-check-circle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <hr>
            <div>
                <p><label>Definições de Conta</label></p>
            </div>
            <hr>
            <div class="media">
                <div class="media-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($user, 'username', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'disabled' => 'disabled'])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($cliente, 'Nome', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?=
                            $form->field($cliente, 'DataNascimento')->widget(DatePicker::classname(), [
                                'pluginOptions' => [
                                    'language' => 'pt',
                                    'format' => 'dd-M-yyyy',
                                    'todayHighlight' => true,
                                    'autoclose' => true,
                                ]
                            ])->label(null, ['class' => 'color-orange']);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($user, 'email', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($cliente, 'Genero', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->dropDownList(['0' => 'Masculino', '1' => 'Feminino', '2' => 'Outro'])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($cliente, 'BI', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($cliente, 'Telefone', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div id="mapa" style="width: 100%; height: 400px;"></div>
                    <div class="clearfix">&nbsp;</div>
                    <?= $form->field($morada, 'Endereco', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textInput(['maxlength' => true, 'id' => 'mapa-address'])->label(null, ['class' => 'color-orange']); ?>
                    <?= $form->field($morada, 'Latitude', ['template' => "{input}", 'options' => ['tag' => null]])->hiddenInput(['id' => 'mapa-lat'])->label(false); ?>
                    <?= $form->field($morada, 'Longitude', ['template' => "{input}", 'options' => ['tag' => null]])->hiddenInput(['id' => 'mapa-lon'])->label(false); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($user, 'password', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->passwordInput(['maxlength' => true])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($user, 'novaPassword', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->passwordInput(['maxlength' => true])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($user, 'confirmarPassword', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->passwordInput(['maxlength' => true])->label(null, ['class' => 'color-orange']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-block', 'role' => 'button']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <div class="clearfix"></div>
    </div>
    <!--    <div class="row">
    <?php
//        $form->field($model, 'oldpassword', [
//            'template' => '<label class="col-lg-3 col-md-3 control-label text-muted text-right">Password Atual:</label> <div class="col-lg-8 col-md-8">{input}{error}{hint}</div>',
//        ])->passwordInput()->label(false)
    ?>
        </div>
        <div class="row">
    <?php
//        $form->field($model, 'newpassword', [
//            'template' => '<label class="col-lg-3 col-md-3 control-label text-muted text-right">Nova Password:</label> <div class="col-lg-8 col-md-8">{input}{error}{hint}</div>',
//        ])->passwordInput()->label(false)
    ?>
        </div>
        <div class="row">
    <?php
//        $form->field($model, 'confirm_password', [
//            'template' => '<label class="col-lg-3 col-md-3 control-label text-muted text-right">Confirmar Password:</label> <div class="col-lg-8 col-md-8">{input}{error}{hint}</div>',
//        ])->passwordInput()->label(false)
    ?>
        </div>-->
</div>