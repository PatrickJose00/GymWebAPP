<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Adicionar Exercício');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Exercício'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planoexercicio-create">
    <?=
    $this->render('_form', [
        'exercicio' => $exercicio,
        'exercicioPlano' => $exercicioPlano,
    ])
    ?>

</div>
