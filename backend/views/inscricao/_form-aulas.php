<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Cliente;
use backend\models\Aula;
use backend\models\User;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-musculacao-form">
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-slide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i></strong>  <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Dados a Preencher</h3>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?=
            $form->field($registo, 'Cliente_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Cliente::find()->all(), 'id', function($model, $defaultValue) {
                            $numeroCliente = User::findOne($model['User_id'])->username;
                            return $model['Nome'] . ' (' . $numeroCliente . ')';
                        }),
                'language' => 'pt',
                'options' => ['prompt' => Yii::t('app', 'Seleciona o Cliente')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label(null, ['for' => 'registo-cliente_id']);
            ?>
            <?=
                    $form->field($inscricao, "Aula_id")
                    ->checkboxList(ArrayHelper::map(Aula::find()->all(), 'id', 'Nome'), [
                        'item' => function($index, $label, $name, $checked, $value) {
                            $aula = Aula::findOne($value);
                            $totalAulas = Aula::find()->count();
                            $item = '<div class="col-md-3 col-sm-3 col-xs-12">';
                            $item .= '<div class="columns">';
                            $item .= '<ul class="price-aulas">';
                            $item .= '<li class="header">' . $label . '</li>';
                            $item .= '<li class="grey">€' . $aula->Preco . ' / aula</li>';
                            $image = !empty($aula->ImageFile) ? $aula->ImageFile : "no-available.png";
                            $item .= '<li>' . Html::img(Yii::getAlias('@web' . '/aulas/' . $image), ['width' => '350', 'height' => '200', 'alt' => $label, 'title' => $label]) . '</li>';
                            $item .= '<li class="highlight">' . $aula->Descricao . '</li>';
                            $item .= '<li class="grey">';
                            $item .= '<a href="#" class="button"><input type="checkbox" id="checkbox-' . $index . '" name="' . $name . '" value="' . $value . '" ' . $checked . '><label for="checkbox-' . $index . '">Inscrever</label></a>';
                            $item .= '</li>';
                            $item .= '</ul>';
                            $item .= '</div>';
                            $item .= '</div>';
                            $item .= $totalAulas - 1 == $index ? '<div class="clearfix"></div>' : '';
                            return $item;
                        }
                    ])->label("Aulas", ['class' => 'label-forms']);
            ?>
            <?= $form->field($registo, 'OutrosDetalhes', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textarea(['maxlength' => true, 'rows' => '5', 'value' => $renovacao, 'placeholder' => Yii::t('app', 'Detalhes importantes..')])->label(null, ['for' => 'registo-outrosdetalhes']) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($registo->isNewRecord ? Yii::t('app', 'Efetuar Inscrição') : Yii::t('app', 'Atualizar'), ['class' => $registo->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>