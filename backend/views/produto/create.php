<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Produto */

$this->title = Yii::t('app', 'Adicionar Produto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Produtos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>