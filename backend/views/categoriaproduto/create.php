<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Categoriaproduto */

$this->title = Yii::t('app', 'Adicionar Categoria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Categoria'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoriaproduto-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
