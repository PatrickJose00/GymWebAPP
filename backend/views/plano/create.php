<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Adicionar Plano de Treino');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem Planos de Treino'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-create">
    <?=
    $this->render('_form', [
        'planoTreino' => $planoTreino,
    ])
    ?>
</div>