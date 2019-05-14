<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
            'modelClass' => 'Plano Exercício',
        ]) . $planoTreino->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem Planos de Treino'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $planoTreino->Nome, 'url' => ['view', 'id' => $planoTreino->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="plano-update">

    <?=
    $this->render('_form', [
        'planoTreino' => $planoTreino,
    ])
    ?>

</div>
