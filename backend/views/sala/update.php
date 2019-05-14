<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Sala */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Sala',
]) . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Salas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="sala-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
