<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title = Yii::t('app', 'Adicionar Cliente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Listagem de Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-create">
    <?=
    $this->render('_form', [
        'cliente' => $cliente,
        'user' => $user,
        'morada' => $morada,
        'lat' => $lat,
        'long' => $long
    ])
    ?>

</div>
