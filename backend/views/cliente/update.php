<?php
/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title = Yii::t('app', 'Atualizar {modelClass} ', [
            'modelClass' => 'Cliente',
        ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $cliente->id, 'url' => ['view', 'id' => $cliente->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cliente-update">
    <?=
    $this->render('_form', [
        'user' => $user,
        'cliente' => $cliente,
        'morada' => $morada,
        'lat' => $lat,
        'long' => $long
    ])
    ?>

</div>
