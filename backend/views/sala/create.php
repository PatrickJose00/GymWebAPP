<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Sala */

$this->title = Yii::t('app', 'Adicionar Sala');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Salas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sala-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
