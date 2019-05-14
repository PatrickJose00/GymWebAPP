<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pack */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Mensalidade',
]) . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Mensalidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="modalidade-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
