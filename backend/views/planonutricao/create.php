<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Adicionar Alimento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Alimentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planonutricao-create">
    <?=
    $this->render('_form', [
        'alimentoPlanoRefeicao' => $alimentoPlanoRefeicao,
        'alimentoHasPlanoRefeicao' => $alimentoHasPlanoRefeicao,
        'planoHasRefeicao' => $planoHasRefeicao
    ])
    ?>
</div>
