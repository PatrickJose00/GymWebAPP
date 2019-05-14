<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Cliente;
use backend\models\Pack;
use backend\models\User;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-musculacao-form">
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
            <section id="packs">
                <h2 class="sectionintro white">:: Mensalidades ::</h2>
                <?=
                        $form->field($mensalidade, 'Pack_id')
                        ->radioList(
                                ArrayHelper::map(Pack::find()->all(), 'id', 'Nome'), [
                            'item' => function($index, $label, $name, $checked, $value) {
                                $item = '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 wow zoomInDown">'; /* div col */
                                $item .= '<div class="panel">'; /* div panel */
                                $item .= '<div class="panel-heading">'; /* div heading */
                                $item .= '<h3 class="panel-title"><label for="pack' . $value . '"><i class="fa fa-hand-o-right" aria-hidden="true"></i> ' . $label . '</label></h3>';
                                $item .= '</div>'; /* div heading */
                                $item .= '<div class="panel-body">'; /* div body */
                                $content = Pack::findOne($value);
                                $descricao = explode(',', $content->Descricao);
                                foreach ($descricao as $eachDescricao) {
                                    $item .= '<p><i class="fa fa-check-square"></i>' . $eachDescricao . '</p>';
                                }
                                $entradas = $content->NumeroEntradas == 0 ? "Livre" : $content->NumeroEntradas . "x por semana";
                                $item .= '<p><i class="fa fa-check-square"></i>' . $entradas . '</p>';
                                $item .= '</div>'; /* div body */
                                $item .= '<div class="panel-footer">'; /* div footer */
                                $preco = $content->Preco;
                                $priceDivided = explode('.', $preco);
                                $item .= '<h5 class="price"><label for="pack' . $value . '">€' . $priceDivided[0] . '<sup>.' . $priceDivided[1] . '</sup></label></h5>';
                                $item .= '<div class="radio-btn">'; /* div radio-btn */
                                $item .= '<input id="pack' . $value . '" type="radio" value="' . $value . '" name="pack">';
                                $item .= '</div>'; /* div radio-btn */
                                $item .= '</div>'; /* div footer */
                                $item .= '</div>'; /* div panel */
                                $item .= '</div>'; /* div col */
                                return $item;
                            }
                                ]
                        )
                        ->label(false);
                ?>
                <div class="clearfix"></div>
            </section>

            <?= $form->field($registo, 'OutrosDetalhes', ['template' => '{label}{input}<span class="help-block">{hint}{error}</span>'])->textarea(['maxlength' => true, 'value' => $renovacao, 'rows' => '5', 'placeholder' => Yii::t('app', 'Detalhes importantes..')])->label(null, ['for' => 'registo-outrosdetalhes']) ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton($registo->isNewRecord ? Yii::t('app', 'Efetuar Inscrição') : Yii::t('app', 'Atualizar'), ['class' => $registo->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>