<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sessão';
?>
<!--<div class="site-login">
    <div class="row">
        <div class="col-lg-5">
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('app', 'Número de cliente')])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput()->label(false) ?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
<?= Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>-->


<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(<?= Yii::getAlias('@web') . '/images/img_bg_2.jpg'?>);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="display-t">
                    <div class="display-tc animate-box" data-animate-effect="fadeIn">
                        <h1><?= Html::encode($this->title) ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="clearfix"></div>
<div class="site-login">
    <div class="container">
        <div class="row">
            <div class="col-md-12 animate-box">
                <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('app', 'Número de cliente')])->label(false) ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Palavra-passe')])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                </div>
                <div class="form-group col-md-offset-3">
                    <?= Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>