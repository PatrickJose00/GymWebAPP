<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Galeriainicial */

$this->title = Yii::t('app', 'Adicionar Imagem');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Professores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galeriasuperior-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
