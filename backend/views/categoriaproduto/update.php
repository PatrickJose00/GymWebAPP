<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Categoriaproduto */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Categoria',
]) . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="categoriaproduto-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
