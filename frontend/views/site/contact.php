<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contactos';
?>
<!--<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="display-t">
                    <div class="display-tc animate-box" data-animate-effect="fadeIn">
                        <h1>Contact Us</h1>
                        <h2>Free html5 templates Made by <a href="http://freehtml5.co" target="_blank">freehtml5.co</a></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>-->
<div id="map" class="fh5co-map"></div>
<div class="site-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-push-1 animate-box">

                <div class="fh5co-contact-info">
                    <h3>Informações</h3>
                    <ul>
                        <li class="address">Rua Pereira de Baixo nº 241, Britelo,<br> 4890-280, Celorico de Basto, Braga</li>
                        <li class="phone"><a href="tel://+351255 322 982">+351 255 322 982</a></li>
                        <li class="email"><a href="mailto:info@gymcbt.com">info@AgonGym.com</a></li>
                        <li class="url"><a href="http://gymcbt.com">AgonGym.com</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-md-6 animate-box">
                <h3>Contacte-nos</h3>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'fname')->textInput(['id' => 'fname', 'placeholder' => 'Primeiro Nome'])->label(false) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'lname')->textInput(['id' => 'lname', 'placeholder' => 'Apelido'])->label(false) ?>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'email')->textInput(['id' => 'email', 'placeholder' => 'E-mail'])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'subject')->textInput(['id' => 'subject', 'placeholder' => 'Assunto'])->label(false)  ?>
                    </div>
                </div>
                <?= $form->field($model, 'body')->textarea(['rows' => 10, 'cols' => 30, 'placeholder' => 'Mensagem..'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar Mensagem', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>