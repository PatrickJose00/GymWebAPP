<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Adicionar Aula');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Aulas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
