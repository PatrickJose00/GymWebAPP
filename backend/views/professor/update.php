<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Professor */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Professor',
]) . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Professores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="professor-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
