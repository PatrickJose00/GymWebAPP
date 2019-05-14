<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Exercício',
]) . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem Planos de Treino'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="planoexercicio-update">

    <?= $this->render('_form', [
        'exercicio' => $exercicio,
        'exercicioPlano' => $exercicioPlano,
    ]) ?>

</div>
