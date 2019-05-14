<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
?>
<nav class="fh5co-nav" role="navigation">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <p class="num">+351 255 322 982</p>
                    <ul class="fh5co-social">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                        <li><a href="#"><i class="icon-github"></i></a></li>
                        <?php
                        if (!Yii::$app->user->isGuest):
                            echo '<li class="pull-right">'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    '<i class="fa fa-user fa-1" aria-hidden="true"></i> Terminar Sessão (' . Yii::$app->user->identity->username . ')', ['class' => 'logout']
                            )
                            . Html::endForm()
                            . '</li>';
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="fh5co-logo"><a href="<?= Url::to(['site/index']); ?>"><img src="<?= Yii::getAlias('@web') . '/images/logo_agon_gym_small.png' ?>" class="img-responsive" /></a></div>
                </div>
                <div class="col-xs-10 text-right menu-1">
                    <ul>
<!--                        <li class="active"><a href="<?php //Url::to(['site/index']);      ?>">Início</a></li>-->
                        <li><a href="<?= Url::to(['site/index', '#' => 'fh5co-services']); ?>">Aulas</a></li>
                        <li><a href="<?= Url::to(['site/index', '#' => 'fh5co-trainer']); ?>">Personal Trainers</a></li>
                        <li><a href="<?= Url::to(['site/index', '#' => 'fh5co-pricing']); ?>">Preçário</a></li>
                        <li><a href="<?= Url::to(['site/index', '#' => 'fh5co-schedule']); ?>">Horário</a></li>
                        <li><a href="<?= Url::to(['site/index', '#' => 'fh5co-gallery']); ?>">Galeria</a></li>
                        <!--                        <li class="has-dropdown">
                                                    <a href="blog.html">Blog</a>
                                                    <ul class="dropdown">
                                                        <li><a href="#">Web Design</a></li>
                                                        <li><a href="#">eCommerce</a></li>
                                                        <li><a href="#">Branding</a></li>
                                                        <li><a href="#">API</a></li>
                                                    </ul>
                                                </li>-->
                        <li><a href="<?= Url::to(['site/contact']); ?>">Contactos</a></li>
                        <?php
                        if (Yii::$app->user->isGuest):
                            ?>
                            <li><a href="<?= Url::to(['site/login']); ?>">Entrar</a></li>
                            <?php
                        elseif (!Yii::$app->user->isGuest && User::isAdmin(Yii::$app->user->identity->username)):
                            ?>
                            <li><a href="<?= Url::to(['/admin']); ?>">Administração</a></li>
                            <?php
                        else:
                            ?>
                            <li><a href="<?= Url::to(['perfil/index']); ?>">Área Pessoal</a></li>
                        <?php
                        endif;
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>