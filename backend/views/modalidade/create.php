<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pack */

$this->title = Yii::t('app', 'Adicionar Mensalidade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Mensalidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modalidade-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
