<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Professor */

$this->title = Yii::t('app', 'Adicionar Professor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Professores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professor-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
