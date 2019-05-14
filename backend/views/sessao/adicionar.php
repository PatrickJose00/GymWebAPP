<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title = Yii::t('app', 'Adicionar Sessão');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Clientes'), 'url' => ['cliente/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adicionar-sessao">
    <?= $this->render('_form', [
        'sessao' => $sessao
    ]) ?>
</div>
