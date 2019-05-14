<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
            'modelClass' => 'Plano Nutrição',
        ]) . $planoNutricao->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Planos Nutrição'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $planoNutricao->Nome, 'url' => ['view', 'id' => $planoNutricao->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="plano-update">

    <?=
    $this->render('_form', [
        'planoNutricao' => $planoNutricao,
    ])
    ?>

</div>
