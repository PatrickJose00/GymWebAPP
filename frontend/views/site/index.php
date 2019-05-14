<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Página Inicial');
$js = <<<JS
    $(".regular").slick({
      dots: true,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true
    });
    $(".group1").colorbox({rel:'group1'});
    $("#click").click(function(){ 
            $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
            return false;
    });
JS;
$this->registerJs($js);
?>

<div class="fh5co-loader"></div>

<div id="page">
    <header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url(images/img_bg_2.jpg);" data-stellar-background-ratio="0.5">
        <div class="container-fluid">
            <section class="regular slider">
                <?php foreach ($galeriaInicial as $imgInicial): ?>
                    <div class="box-slider">
                        <div class="content-slide">
                            <strong class="header-slide">Bem-vindo ao AgonGym</strong>
                            <p>
                                Tomar a decisão de participar num ginásio é o primeiro grande passo para melhorar a sua saúde e qualidade de vida. No AgonGym, 
                                estamos aqui para ajudar a tornar a sua experiência de ginásio divertido, eficaz e fácil. O AgonGym dedica a dar às pessoas uma 
                                grande experiência de fitness, ajudando as pessoas de todos os níveis de fitness alcançar seus objetivos. Se o seu objetivo 
                                é manter-se em forma, perder peso ou ficar apto para um próximo evento, estamos aqui para você.
                            </p>
                        </div>
                        <img src="<?= Yii::getAlias('@web') . "/gallery-top/{$imgInicial->Imagem}" ?>" class="img-responsive">
                    </div>
                <?php endforeach; ?>
            </section>
        </div>
    </header>

    <div id="fh5co-services" class="fh5co-bg-section">
        <div class="container">
            <div class="row">
                <?php foreach ($aulas as $aula): ?>
                    <div class="col-md-4 text-center animate-box">
                        <div class="services">
                            <span><img class="img-responsive" src="images/dumbbell.svg" alt=""></span>
                            <h3><?= $aula->Nome ?></h3>
                            <p><?= $aula->Descricao = ((strlen($aula->Descricao)) >= 150 ? mb_substr($aula->Descricao, 0, 150) . '...' : $aula->Descricao) ?></p>
                        
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="fh5co-trainer">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2><i>Personal Trainers</i></h2>
                    <p>
                        Exigimos o melhor de nossos <i>Personal Trainers</i>, para que eles possam exigir o melhor de si. Os nossos Personal Trainers têm de cumprir elevados padrões de excelência em fisiologia do exercício, nutrição, anatomia, desenvolvimento de programas de treino, aplicação de exercícios, exames de saúde e avaliações de condicionamento físico. Mas o mais importante, os nossos <i>Personal Trainers</i> destacam-se em aplicar os seus conhecimentos a todas as esferas da vida, desde atletas a idosos.
                    </p>
                </div>
            </div>
            <div class="row">
                <?php foreach ($professores as $professor): ?>
                    <div class="col-md-4 col-sm-4 animate-box">
                        <div class="trainer">
                            <a href="#"><img class="img-responsive" src="<?= Yii::getAlias('@web') . '/backend/web/professores/' . $professor->Foto ?>" alt="<?= $professor->Nome ?>"></a>
                            <div class="title">
                                <h3><a href="#"><?= $professor->Nome ?></a></h3>
                                <span>Dance Expert</span>
                            </div>
                            <div class="desc text-center">
                                <ul class="fh5co-social-icons">
                                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                                    <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                    <li><a href="#"><i class="icon-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div id="fh5co-schedule" class="fh5co-bg" style="background-image: url(images/img_bg_1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                    <h2>Horário</h2>
                </div>
            </div>

            <div class="row animate-box">
                <?php
                $arrayDias = [];
                $arraySessoes = ['PrimeiraSessao', 'SegundaSessao'];
                $diasDaSemana = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $diasDaSemanaPT = ['Monday' => 'Segunda', 'Tuesday' => 'Terça', 'Wednesday' => 'Quarta', 'Thursday' => 'Quinta', 'Friday' => 'Sexta', 'Saturday' => 'Sábado', 'Sunday' => 'Domingo'];
                $i = 0;
                foreach ($sessoes as $sessao) {
                    foreach ($arraySessoes as $value) {
                        $_sessao = $sessao->$value;
                        $diaSemana = date('l', $_sessao);
                        $horaIncio = date('H\:i', $_sessao);
                        $horaFim = date('H\:i', $_sessao + $sessao->Duracao);
                        $professor = $sessao->aula->professor->Nome;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['HoraInicio'] = $horaIncio;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['HoraFim'] = $horaFim;
                        $arrayDias[$diaSemana][$sessao->aula->Nome][$i]['Professor'] = $professor;
                    }
                    $i++;
                }

                foreach ($arrayDias as $key => $item) {
                    $diasSemanaa[$key][] = $item;
                }

                foreach ($diasDaSemana as $semana_ordem => $dia_nome) {
                    if (isset($diasSemanaa[$dia_nome])) {
                        foreach ($diasSemanaa[$dia_nome] as $sp) {
                            $sorted_semana[$dia_nome] = $sp;
                        }
                    }
                }
                ?>


                <div class="fh5co-tabs">
                    <ul class="fh5co-tab-nav">
                        <?php $dataTab = 1; ?>
                        <?php foreach ($diasDaSemanaPT as $key => $dia): ?>
                            <?php foreach ($sorted_semana as $keyDia => $valueCheck): ?>
                                <?php if ($key == $keyDia): ?>
                                    <?php if ($dataTab == 1): ?>
                                        <li class="active"><a href="#" data-tab="<?= $dataTab++ ?>"><span class="visible-xs"><?php substr($dia, 0, 1); ?></span><span class="hidden-xs"><?= $dia ?></span></a></li>
                                    <?php else: ?>
                                        <li><a href="#" data-tab="<?= $dataTab++ ?>"><span class="visible-xs"><?php substr($dia, 0, 1); ?></span><span class="hidden-xs"><?= $dia ?></span></a></li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Tabs -->
                    <div class="fh5co-tab-content-wrap">
                        <?php $tabContent = 1; ?>
                        <?php foreach ($sorted_semana as $nameweek => $week): ?>
                            <div class="fh5co-tab-content tab-content <?= $active = $tabContent == 1 ? "active" : "" ?>" data-tab-content="<?= $tabContent++ ?>">
                                <ul class="class-schedule">
                                    <?php foreach ($week as $nameSport => $sport): ?>
                                        <?php foreach ($sport as $details): ?>
                                            <li class="text-center">
                                                <span><img src="images/exercise.svg" class="img-responsive" alt=""></span>
                                                <span class="time"><?= $details['HoraInicio'] . 'h' ?> - <?= $details['HoraFim'] . 'h' ?></span>
                                                <h4><?= $nameSport ?></h4>
                                                <small><?= $details['Professor'] ?></small>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fh5co-pricing">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Preçário</h2>
                    <p>Os melhores preços do mercado! Aparece no nosso ginásio para saberes mais detalhes sobre as nossas mensalidades.</p>
                </div>
            </div>
            <div class="row">
                <div class="pricing">
                    <?php foreach ($packs as $pack): ?>
                        <div class="col-md-3 animate-box">
                            <div class="price-box">
                                <h2 class="pricing-plan"><?= $pack->Nome ?></h2>
                                <div class="price"><sup class="currency">€</sup><?= $pack->Preco ?><small>/mês</small></div>
                                <?php $detalhesPack = explode(',', $pack->Descricao); ?>
                                <ul class="classes">
                                    <?php foreach ($detalhesPack as $key => $pack): ?>
                                        <?php $class = $key % 2 == 0 ? "" : 'class="color"'; ?><!--par--> 
                                        <li <?= $class ?>><?= $pack ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <!--                                <a href="#" class="btn btn-select-plan btn-sm">Select Plan</a>-->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($galeriaGym)): ?>
        <div id="fh5co-gallery">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                        <h2>Galeria Ginásio</h2>
                        <p>Descobre tudo o que te pode oferecer o nosso Ginásio.</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row row-bottom-padded-md">
                    <?php foreach ($galeriaGym as $imgGym): ?>
                        <div class="col-md-3 animate-box">
                            <a class="group1" href='<?= Yii::getAlias('@web') . "/gallery-inside/{$imgGym->Imagem}" ?>' title="" alt="">
                                <img src='<?= Yii::getAlias('@web') . "/gallery-inside/{$imgGym->Imagem}" ?>' class="img-responsive imgs-gym-inside"/>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!--    <div id="fh5co-testimonial" class="fh5co-bg-section">
            <div class="container">
                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>Happy Clients</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row animate-box">
                            <div class="owl-carousel owl-carousel-fullwidth">
                                <div class="item">
                                    <div class="testimony-slide active text-center">
                                        <figure>
                                            <img src="images/person3.jpg" alt="user">
                                        </figure>
                                        <span>Jean Doe, via <a href="#" class="twitter">Twitter</a></span>
                                        <blockquote>
                                            <p>&ldquo;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimony-slide active text-center">
                                        <figure>
                                            <img src="images/person3.jpg" alt="user">
                                        </figure>
                                        <span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
                                        <blockquote>
                                            <p>&ldquo;Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimony-slide active text-center">
                                        <figure>
                                            <img src="images/person3.jpg" alt="user">
                                        </figure>
                                        <span>John Doe, via <a href="#" class="twitter">Twitter</a></span>
                                        <blockquote>
                                            <p>&ldquo;Far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.&rdquo;</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->


    <!--    <div id="fh5co-started" class="fh5co-bg" style="background-image: url(images/img_bg_3.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <h2>Fitness Classes this Summer <br> <span> Pay Now and <br> Get <span class="percent">35%</span> Discount</span></h2>
                    </div>
                </div>
                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <p><a href="#" class="btn btn-default btn-lg">Become a Member</a></p>
                    </div>
                </div>
            </div>
        </div>-->

    <!--    <div id="fh5co-blog" class="fh5co-bg-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
                        <h2>Recent Blog</h2>
                        <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
                    </div>
                </div>
                <div class="row row-bottom-padded-md">
                    <div class="col-lg-4 col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#"><img class="img-responsive" src="images/gallery-4.jpg" alt=""></a>
                            <div class="blog-text">
                                <h3><a href=""#>45 Minimal Worksspace Rooms for Web Savvys</a></h3>
                                <span class="posted_on">Sep. 15th</span>
                                <span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#"><img class="img-responsive" src="images/gallery-2.jpg" alt=""></a>
                            <div class="blog-text">
                                <h3><a href=""#>45 Minimal Worksspace Rooms for Web Savvys</a></h3>
                                <span class="posted_on">Sep. 15th</span>
                                <span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#"><img class="img-responsive" src="images/gallery-3.jpg" alt=""></a>
                            <div class="blog-text">
                                <h3><a href=""#>45 Minimal Worksspace Rooms for Web Savvys</a></h3>
                                <span class="posted_on">Sep. 15th</span>
                                <span class="comment"><a href="">21<i class="icon-speech-bubble"></i></a></span>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>