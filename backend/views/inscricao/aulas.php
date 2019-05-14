<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title = Yii::t('app', 'Inscrição Aulas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Clientes'), 'url' => ['cliente/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-aulas">
    <?= $this->render('_form-aulas', [
        'registo' => $registo,
        'inscricao' => $inscricao,
        'renovacao' => $renovacao
    ]) ?>
</div>
