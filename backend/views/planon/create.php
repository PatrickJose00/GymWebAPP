<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\aula */

$this->title = Yii::t('app', 'Adicionar Plano Nutrição');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Planos Nutrição'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planon-create">
    <?=
    $this->render('_form', [
        'planoNutricao' => $planoNutricao,
    ])
    ?>
</div>