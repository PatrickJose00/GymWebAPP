<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategoriaproduto */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Subcategoria',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Subcategorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Atualizar');
?>
<div class="subcategoriaproduto-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
