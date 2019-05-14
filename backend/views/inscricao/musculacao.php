<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title = Yii::t('app', 'Inscrição Musculação');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Clientes'), 'url' => ['cliente/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-musculacao">
    <?= $this->render('_form-musculacao', [
        'registo' => $registo,
        'mensalidade' => $mensalidade,
        'renovacao' => $renovacao
    ]) ?>
</div>
