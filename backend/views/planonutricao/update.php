<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Atualizar {modelClass} ', [
            'modelClass' => 'Conteúdo do Plano',
        ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Alimentos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="planonutricao-update">
    <?=
    $this->render('_form', [
        'alimentoPlanoRefeicao' => $alimentoPlanoRefeicao,
        'alimentoHasPlanoRefeicao' => $alimentoHasPlanoRefeicao,
        'planoHasRefeicao' => $planoHasRefeicao,
        'alimentos' => $alimentos,
        'horarios' => $horarios,
        'pesos' => $pesos
    ])
    ?>
</div>
