<?php

use yii\helpers\Html;

$this->title = "Página de Perfil";
$this->params['user'] = $user;
$this->params['mensalidadeAtual'] = $mensalidadeAtual;
?>
<?php
switch ($user->cliente->Genero) {
    case "0":
        $result = "Masculino";
        break;
    case "1":
        $result = "Feminino";
        break;
    case "2":
        $result = "Outro";
        break;
}
?>
<div class="panel panel-default">
    <div class="panel-body">
        <hr>
        <div>
            <p><label>Informações Pessoais</label></p>
        </div>
        <hr>
        <div class="media">
            <div class="media-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="color-orange"><?= Yii::t('app', 'Número Cliente') ?></label>
                        <?= Html::input('text', null, $user->username, ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-top-md">
                        <label class="color-orange"><?= Yii::t('app', 'Nome') ?></label>
                        <?= Html::input('text', null, $user->cliente->Nome, ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-top-md">
                        <label class="color-orange"><?= Yii::t('app', 'Género') ?></label>
                        <?= Html::input('text', null, $result, ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row mt-top-md">
                    <div class="col-md-6">
                        <label class="color-orange"><?= Yii::t('app', 'Data de Nascimento') ?></label>
                        <?= Html::input('text', null, date('d-M-Y', $user->cliente->DataNascimento), ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                    <div class="col-md-6">
                        <label class="color-orange"><?= Yii::t('app', 'Bilhete de Entidade') ?></label>
                        <?= Html::input('text', null, $user->cliente->BI, ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row mt-top-md">
                    <div class="col-md-12">
                        <label class="color-orange"><?= Yii::t('app', 'Número de Contribuinte') ?></label>
                        <?= Html::input('text', null, $user->cliente->Contribuinte, ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row mt-top-md">
                    <div class="col-md-12">
                        <label class="color-orange"><?= Yii::t('app', 'Telefone') ?></label>
                        <?= Html::input('text', null, $user->cliente->Telefone, ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                </div>
                <div class="row mt-top-md">
                    <div class="col-md-12">
                        <label class="color-orange"><?= Yii::t('app', 'Morada') ?></label>
                        <?= Html::input('text', null, $user->cliente->morada->Endereco, ['disabled' => 'disabled', 'class' => 'form-control']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>