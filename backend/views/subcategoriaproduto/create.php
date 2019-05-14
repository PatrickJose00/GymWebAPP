<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Subcategoriaproduto */

$this->title = Yii::t('app', 'Adicionar Subcategoria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Subcategoria'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcategoriaproduto-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
