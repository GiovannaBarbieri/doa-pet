<?php
   require_once '/home/wmbar465/public_html/doapet.com.br/Controller/UtilController.php';
   require_once '/home/wmbar465/public_html/doapet.com.br/Controller/AnuncioController.php';
   $objcontroller = new AnuncioController();
   $ultimos_anuncios = $objcontroller->CarregarUltimosAnunciosPortal();
   $contar_anuncios = $objcontroller->ContarAnuncios();
   $contar_pessoa = $objcontroller->ContarPessoasCadastradas();
   $contar_interessados = $objcontroller->ContarPessoasInteressadas();
   $contar_mensagens = $objcontroller->ContarMensagens();
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="site/assets/img/favicon.ico">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="DoaPet - site para adotar ou doar animais" />
	<meta name="description" content="DoaPet site para doação de animais como gatos, cachorros. Adote ou doe um animal, animais para doação, animais para adoção, filhotes e adultos, adotar um pet.">
	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="template/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="template/css/style.css" type="text/css" />
	<link rel="stylesheet" href="template/css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="template/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="template/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="template/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="template/css/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="template/css/responsive.css" type="text/css" />
	<link rel="stylesheet" href="template/css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<!-- Document Title
	============================================= -->
	<title>Site para doação de animais, gatos, cachoros e mais.</title>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108317440-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-108317440-1');
        </script>

</head>
<body class="stretched">
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
		<!-- Header
		============================================= -->
		<header id="header" class="full-header" data-sticky-class="dark">
			<div id="header-wrap">
				<div class="container clearfix">
					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
					<!-- Logo
					============================================= -->
					<div id="logo">
                                            <a href="index.php" class="" data-dark-logo="template/images/logo-branco-doapet.png" title="DoaPet - Doação de Animais"><img src="template/images/logo-branco-doapet.png" alt="Logo DoaPet" title="DoaPet Doação de Animais"> </a>
						
					</div><!-- #logo end -->
					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu" class="dark">
						<ul>
							<li class="current"><a href="index.php" title="Inicial - doação de animais"><div>Página Inicial</div></a></li>
                                                        <li class="current"><a href="#" data-scrollto="#content" title="Sobre - doação de animais"><div>Sobre</div></a></li>
							<li class="current"><a href="site/acesso.php" title="Ver animais para doação"><div>Acesso</div></a></li>
                                                        <li class="current"><a href="site/novaconta.php" title="Criar conta - doar de animais"><div>Cadastre-se</div></a></li>
						</ul>
						<!-- Top Search
						============================================= -->
					<!--	<div id="top-search">
							<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
							<form action="search.html" method="get">
								<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
							</form>
						</div><!-- #top-search end -->

					</nav><!-- #primary-menu end -->
				</div>
			</div>
		</header><!-- #header end -->

		<section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix">
			<div class="slider-parallax-inner">

				<div class="swiper-container swiper-parent">
					<div class="swiper-wrapper">
						<div class="swiper-slide dark" style="background-image: url('template/images/slider/swiper/1.jpg');">
							<div class="container clearfix">
								<div class="slider-caption slider-caption-center">
									<h2 data-caption-animate="fadeInUp">Bem vindo ao DoaPet</h2>
									<p data-caption-animate="fadeInUp" data-caption-delay="200">Aqui você pode anúnciar um pet para a doação ou pode adotar um dos bichinhos que outras pessoas querem doar.<br/> O DOAPET É GRÁTIS</p>
								</div>
							</div>
						</div>
					<!--	<div class="swiper-slide dark">
							<div class="container clearfix">
								<div class="slider-caption slider-caption-center">
									<h2 data-caption-animate="fadeInUp">Beautifully Flexible</h2>
									<p data-caption-animate="fadeInUp" data-caption-delay="200">Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>
								</div>
							</div>
							<div class="video-wrap">
								<video id="slide-video" poster="template/images/videos/explore.jpg" preload="auto" loop autoplay muted>
									<source src='template/images/videos/explore.webm' type='video/webm' />
									<source src='template/images/videos/explore.mp4' type='video/mp4' />
								</video>
								<div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
							</div>
						</div> -->
						<div class="swiper-slide dark" style="background-image: url('template/images/slider/swiper/2.jpg'); background-position: center top;">
							<div class="container clearfix">
								<div class="slider-caption">
									<h2 data-caption-animate="fadeInUp">Doação de Gatos</h2>
									<p data-caption-animate="fadeInUp" data-caption-delay="200">Aqui você pode anúnciar um pet para a doação ou pode adotar um dos bichinhos que outras pessoas querem doar.</p>
								</div>
							</div>
						</div>
					</div>
					<div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
					<div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
				</div>

				<a href="#" data-scrollto="#content" data-offset="100" class="dark one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a>
			</div>
		</section>

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">
					<div class="row clearfix">

						<div class="col-lg-5">
							<div class="heading-block topmargin">
								<h1>A maior plataforma de doações de animais!</h1>
							</div>
							<p class="lead">Anuncie um animal filhote ou adulto para doação ou adote animais de todas as raças e porte pelo site ou aplicativo! No DoaPet você encontra, cachorros, gatos e outros tipos de animais para doação.
                                                        <br>Aguarde mais novidades em breve ...
</p>
						</div>

						<div class="col-lg-7">

							<div style="position: relative; margin-bottom: -80px; margin-top: 67px;" class="ohidden" data-height-lg="426" data-height-md="567" data-height-sm="470" data-height-xs="287" data-height-xxs="183">
                                                            <img src="../site/assets/img/tela-do-sistema-inicial.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="100" alt="O Sistema de doação de animais" title="Tela do sistema para doar e adotar animais">
                                                            <img src="template/images/services/main-fmobile.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="400" alt="Tela do Aplicativo" title="Aplicativo para doar e adotar animais">
							</div>

						</div>

					</div>
				</div>

				<div class="section nobottommargin">
					<div class="container clear-bottommargin clearfix">

						<div class="row topmargin-sm clearfix">

							<div class="col-md-4 bottommargin">
								<i class="i-plain color i-large icon-line2-screen-desktop inline-block" style="margin-bottom: 15px;"></i>
								<div class="heading-block nobottomborder" style="margin-bottom: 15px;">

									<h4>Procurar por localidade</h4>
								</div>
								<p>Escolha os animais que estão mais perto de você e adote, escolha por cidade seu animal desejado, Londrina, Cambé, Ibiporã, Maringá. Em breve todo Brasil.</p>
							</div>

							<div class="col-md-4 bottommargin">
								<i class="i-plain color i-large icon-line2-energy inline-block" style="margin-bottom: 15px;"></i>
								<div class="heading-block nobottomborder" style="margin-bottom: 15px;">

									<h4>Publicar anúncio</h4>
								</div>
								<p>Publique um anúncio de um animal que você queira doar, e veja as pessoas interessadas em adotar seu animalzinho.</p>
							</div>

							<div class="col-md-4 bottommargin">
								<i class="i-plain color i-large icon-line2-equalizer inline-block" style="margin-bottom: 15px;"></i>
								<div class="heading-block nobottomborder" style="margin-bottom: 15px;">

									<h4>Mensagens</h4>
								</div>
								<p>Troque mensagens com o anunciante que quer doar, e tire todas as suas dúvidas sobre o animal (gato, cachorro e etc.) que você tenha interesse.</p>
							</div>

						</div>

					</div>
				</div>

				<div class="container clearfix">

					<div class="row topmargin-lg bottommargin-sm">

						<div class="heading-block center">
							<h2>Aplicativo para doar animais - DoaPet</h2>
							<span class="divcenter">Logo estaremos lançando o melhor aplicativo para doações de animais disponível para download, para você ter todos os anúncios para doação de animais na palma da sua mão!</span>
						</div>

<!--						<div class="col-md-4 col-sm-6 bottommargin">

							<div class="feature-box fbox-right topmargin" data-animate="fadeIn">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-heart"></i></a>
								</div>
								<h3>Boxed &amp; Wide Layouts</h3>
								<p>Stretch your Website to the Full Width or make it boxed to surprise your visitors.</p>
							</div>

							<div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="200">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-paper"></i></a>
								</div>
								<h3>Extensive Documentation</h3>
								<p>We have covered each &amp; everything in our Docs including Videos &amp; Screenshots.</p>
							</div>

							<div class="feature-box fbox-right topmargin" data-animate="fadeIn" data-delay="400">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-layers"></i></a>
								</div>
								<h3>Parallax Support</h3>
								<p>Display your Content attractively using Parallax Sections with HTML5 Videos.</p>
							</div>

						</div>

						<div class="col-md-4 hidden-sm bottommargin center">
							<img src="template/images/services/iphone7.png" alt="iphone 2">
						</div>

						<div class="col-md-4 col-sm-6 bottommargin">

							<div class="feature-box topmargin" data-animate="fadeIn">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-power"></i></a>
								</div>
								<h3>HTML5 Video</h3>
								<p>Canvas provides support for Native HTML5 Videos that can be added to a Background.</p>
							</div>

							<div class="feature-box topmargin" data-animate="fadeIn" data-delay="200">
								<div class="fbox-icon">
									<a href="#"><i class="icon-line-check"></i></a>
								</div>
								<h3>Endless Possibilities</h3>
								<p>Complete control on each &amp; every element that provides endless customization.</p>
							</div>

							<div class="feature-box topmargin" data-animate="fadeIn" data-delay="400">
								<div class="fbox-icon">
									<a href="#"><i class="icon-bulb"></i></a>
								</div>
								<h3>Light &amp; Dark Color Schemes</h3>
								<p>Change your Website's Primary Scheme instantly by simply adding the dark class.</p>
							</div>

						</div>
-->
					</div>

				</div>

				<div class="row clearfix common-height">

					<div class="col-md-6 center col-padding" style="background: url('template/images/services/cachorro-programador-inicial.jpg') center center no-repeat; background-size: cover;">
						<div>&nbsp;</div>
					</div>

					<div class="col-md-6 center col-padding" style="background-color: #F5F5F5;">
						<div>
							<div class="heading-block nobottomborder">
								<span class="before-heading color"></span>
								<h3> video explicativo para utilização do DoaPet:</h3>
							</div>

							<div class="center bottommargin">
                                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/qNgukFjwBoo" frameborder="0" allowfullscreen></iframe>
<!--								<a href="https://youtu.be/qNgukFjwBoo" data-lightbox="iframe" style="position: relative;">
									<img src="template/images/services/video.jpg" alt="Video">
									<span class="i-overlay nobg"><img src="template/images/icons/video-play.png" alt="Play"></span>
								</a>-->
							</div>
                                                    <p class="lead nobottommargin">Veja no vídeo acima como é fácil você se cadastrar no site e anúnciar animais para doar <strong>GRATUITAMENTE</strong> em nosso site</p>
						</div>
					</div>

				</div>

				<div class="row clearfix  common-height">

					<div class="col-md-3 col-sm-6 dark center col-padding" style="background-color: #515875;">
						<div>
							<i class="i-plain i-xlarge divcenter icon-line2-directions"></i>
                                                        <div class="counter counter-lined"><span data-from="100" data-to="<?= $contar_anuncios [0]['qtd_anuncio'] ?>" data-refresh-interval="50" data-speed="2000"></span></div>
							<h5>Anúncios Publicados</h5>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 dark center col-padding" style="background-color: #576F9E;">
						<div>
							<i class="i-plain i-xlarge divcenter icon-line2-graph"></i>
                                                        <div class="counter counter-lined"><span data-from="3000" data-to="<?= $contar_pessoa [0]['qtd_pessoa'] ?>" data-refresh-interval="100" data-speed="2500"></span></div>
							<h5>Pessoas Cadastradas</h5>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 dark center col-padding" style="background-color: #6697B9;">
						<div>
							<i class="i-plain i-xlarge divcenter icon-line2-layers"></i>
                                                        <div class="counter counter-lined"><span data-from="10" data-to="<?= $contar_interessados [0]['qtd_interessado'] ?>" data-refresh-interval="25" data-speed="3500"></span></div>
							<h5>Pessoas Interessadas</h5>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 dark center col-padding" style="background-color: #88C3D8;">
						<div>
							<i class="i-plain i-xlarge divcenter icon-line2-clock"></i>
                                                        <div class="counter counter-lined"><span data-from="60" data-to="<?= $contar_mensagens[0]['qtd_mensagem'] ?>" data-refresh-interval="30" data-speed="2700"></span></div>
							<h5>Mensagens Trocadas</h5>
						</div>
					</div>

				</div>
				<div class="section" style="margin: 0px">
					<div class="container clearfix">

						<div class="row topmargin-sm">

							<div class="heading-block center">
							<h3>Anúncios Recentes - Animais para adotar</h3>
                                                        <span class="divcenter">Esses animais abaixo são 4 últimos cadastrados no site e estão a espera de alguém para adotá-los <a href="site/acesso.php" title="Acesso DoaPet Doação de Animais">acesse já</a> o site ou <a href="site/novaconta.php" title="Cadastro para adotar ou doar animais">cadastre-se</a> e veja outros anúncios como esses.</span>
							</div>
                                                            <?php for($i =0; $i < count($ultimos_anuncios); $i++){ ?>

							<div class="col-md-3 col-sm-6 bottommargin">

								<div class="team">
									<div class="team-image">
									<?php if($ultimos_anuncios[$i]['caminho_foto'] != '') { ?>
                                                                            <img src="site/<?= UtilController::DevolverCaminhoFoto($ultimos_anuncios[$i]['caminho_foto']); ?>" style="min-height:220px;" alt="Foto Animal para doação" title="Animal no site para doação">
									<?php }else { ?>
                                                                            <img src="site/assets/img/anuncio-sem-foto.png" alt="Anúncio Sem Foto" title="Sem foto">
									<?php } ?>
									</div>
									<div class="team-desc team-desc-bg">
										<div class="team-title"><h4><?= $ultimos_anuncios[$i]['titulo_anuncio']?></h4><span><?= $ultimos_anuncios[$i]['nome_pessoa']?></span></div>
										<br/>
                                                                                <a href="http://doapet.com.br/site/acesso.php" class="button button-border button-rounded button-fill fill-from-top button-amber" title="Saiba mais sobre o DoaPet - doar animais"><span>Saiba Mais</span></a>
										</a>
                                                                                <span><?= $tipo = $ultimos_anuncios[0]['nome_tipo']; ?></span>
									</div>
                                                                    
								</div>

							</div>

			<?php } ?>


						</div>

					</div>
				</div>
				<div class="clear"></div>
<!--<a href="portfolio.html" class="button button-full button-dark center tright bottommargin-lg">
					<div class="container clearfix">
						More than 100+ predefined Portfolio Grid Layouts. <strong>See More</strong> <i class="icon-caret-right" style="top:4px;"></i>
					</div>
				</a> -->

<!--				<div class="container clearfix">

					<div class="col_one_third bottommargin-sm center">
						<img data-animate="fadeInLeft" src="template/images/services/iphone6.png" alt="Iphone">
					</div>

					<div class="col_two_third bottommargin-sm col_last">

						<div class="heading-block topmargin-sm">
							<h3>Optimized for Mobile &amp; Touch Enabled Devices.</h3>
						</div>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero quod consequuntur quibusdam, enim expedita sed quia nesciunt incidunt accusamus necessitatibus modi adipisci officia libero accusantium esse hic, obcaecati, ullam, laboriosam!</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti vero, animi suscipit id facere officia. Aspernatur, quo, quos nisi dolorum aperiam fugiat deserunt velit rerum laudantium cum magnam.</p>

						<a href="#" class="button button-border button-dark button-rounded button-large noleftmargin topmargin-sm">Learn more</a>

					</div>

				</div>-->

<!--				<div class="section parallax dark nobottommargin" style="background-image: url('template/images/services/home-testi-bg.jpg'); padding: 100px 0;" data-stellar-background-ratio="0.4">

					<div class="heading-block center">
						<h3>What Clients Say?</h3>
					</div>

					<div class="fslider testimonial testimonial-full" data-animation="fade" data-arrows="false">
						<div class="flexslider">
							<div class="slider-wrap">
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="template/images/testimonials/3.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Similique fugit repellendus expedita excepturi iure perferendis provident quia eaque. Repellendus, vero numquam?</p>
										<div class="testi-meta">
											Steve Jobs
											<span>Apple Inc.</span>
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="template/images/testimonials/2.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
										<div class="testi-meta">
											Collis Ta'eed
											<span>Envato Inc.</span>
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="template/images/testimonials/1.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>
										<div class="testi-meta">
											John Doe
											<span>XYZ Inc.</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>-->

<!--				<div class="section notopmargin notopborder">
					<div class="container clearfix">
						<div class="heading-block center nomargin">
							<h3>Latest from the Blog</h3>
						</div>
					</div>
				</div>-->

<!--				<div class="container clear-bottommargin clearfix">
					<div class="row">

						<div class="col-md-3 col-sm-6 bottommargin">
							<div class="ipost clearfix">
								<div class="entry-image">
									<a href="#"><img class="image_fade" src="template/images/magazine/thumb/1.jpg" alt="Image"></a>
								</div>
								<div class="entry-title">
									<h3><a href="blog-single.html">Bloomberg smart cities; change-makers economic security</a></h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> 13th Jun 2014</li>
									<li><a href="blog-single.html#comments"><i class="icon-comments"></i> 53</a></li>
								</ul>
								<div class="entry-content">
									<p>Prevention effect, advocate dialogue rural development lifting people up community civil society. Catalyst, grantees leverage.</p>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-6 bottommargin">
							<div class="ipost clearfix">
								<div class="entry-image">
									<a href="#"><img class="image_fade" src="template/images/magazine/thumb/2.jpg" alt="Image"></a>
								</div>
								<div class="entry-title">
									<h3><a href="blog-single.html">Medicine new approaches communities, outcomes partnership</a></h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> 24th Feb 2014</li>
									<li><a href="blog-single.html#comments"><i class="icon-comments"></i> 17</a></li>
								</ul>
								<div class="entry-content">
									<p>Cross-agency coordination clean water rural, promising development turmoil inclusive education transformative community.</p>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-6 bottommargin">
							<div class="ipost clearfix">
								<div class="entry-image">
									<a href="#"><img class="image_fade" src="template/images/magazine/thumb/3.jpg" alt="Image"></a>
								</div>
								<div class="entry-title">
									<h3><a href="blog-single.html">Significant altruism planned giving insurmountable challenges liberal</a></h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> 30th Dec 2014</li>
									<li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>
								</ul>
								<div class="entry-content">
									<p>Micro-finance; vaccines peaceful contribution citizens of change generosity. Measures design thinking accelerate progress medical initiative.</p>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-6 bottommargin">
							<div class="ipost clearfix">
								<div class="entry-image">
									<a href="#"><img class="image_fade" src="template/images/magazine/thumb/4.jpg" alt="Image"></a>
								</div>
								<div class="entry-title">
									<h3><a href="blog-single.html">Compassion conflict resolution, progressive; tackle</a></h3>
								</div>
								<ul class="entry-meta clearfix">
									<li><i class="icon-calendar3"></i> 15th Jan 2014</li>
									<li><a href="blog-single.html#comments"><i class="icon-comments"></i> 54</a></li>
								</ul>
								<div class="entry-content">
									<p>Community health workers best practices, effectiveness meaningful work The Elders fairness. Our ambitions local solutions globalization.</p>
								</div>
							</div>
						</div>

					</div>
				</div>-->
<!--				<div class="container clearfix">

					<div id="oc-clients" class="owl-carousel image-carousel carousel-widget" data-margin="60" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xxs="2" data-items-xs="3" data-items-sm="4" data-items-md="5" data-items-lg="6">

						<div class="oc-item"><a href="#"><img src="template/images/clients/1.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/2.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/3.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/4.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/5.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/6.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/7.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/8.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/9.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="template/images/clients/10.png" alt="Clients"></a></div>
					</div>
				</div>-->
			</div>
                                    <div class="container clearfix">

					<div class="row topmargin-lg bottommargin-sm">

						<div class="heading-block center">
							<h2>Faça a Diferença Adote um animal</h2>
							<span class="divcenter">Hoje mais de centenas de animais em todo o Brasil são abandonados na rua, ou sofrem mals tratos pelos seus donos, e existe apenas uma maneira de mudar isso, você fazendo a diferença ! Venha e conheça o DoaPet adote ou doe um animal.</span>
                                                </div> 
                                            <div class="heading-block center">
							<h2>Seu próximo animal está aqui no Doa Pet</h2>
							
                                                </div> 
                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li>Site para doação de cachorros</li>
                                                        <li>Site para doação de gatos</li>
                                                        <li>Site para adotar cachorros</li>
                                                        <li>Site para adotar gatos</li>
                                                    </ul>
                                                </div>    
                                                <div class="col-md-4">
                                                    <ul>
                                                        <li>Adoção de animais online</li>
                                                        <li>Doção de animais online</li>
                                                        <li>Como adotar um animal</li>
                                                        <li>Doe seu pet rapidamente</li>
                                                    </ul>
                                                </div>
                                            </div>
					</div>

				</div>
		</section><!-- #content end -->
                

                
                
		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
<!--			<div class="container">
				 Footer Widgets
				=============================================
				<div class="footer-widgets-wrap clearfix">

					<div class="col_two_third">

						<div class="col_one_third">

							<div class="widget clearfix">

								<img src="template/images/footer-widget-logo.png" alt="" class="footer-logo">

								<p>We believe in <strong>Simple</strong>, <strong>Creative</strong> &amp; <strong>Flexible</strong> Design Standards.</p>

								<div style="background: url('template/images/world-map.png') no-repeat center center; background-size: 100%;">
									<address>
										<strong>Headquarters:</strong><br>
										795 Folsom Ave, Suite 600<br>
										San Francisco, CA 94107<br>
									</address>
									<abbr title="Phone Number"><strong>Phone:</strong></abbr> (91) 8547 632521<br>
									<abbr title="Fax"><strong>Fax:</strong></abbr> (91) 11 4752 1433<br>
									<abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
								</div>

							</div>

						</div>

						<div class="col_one_third">

							<div class="widget widget_links clearfix">

								<h4>Blogroll</h4>

								<ul>
									<li><a href="http://codex.wordpress.org/">Documentation</a></li>
									<li><a href="http://wordpress.org/support/forum/requests-and-feedback">Feedback</a></li>
									<li><a href="http://wordpress.org/extend/plugins/">Plugins</a></li>
									<li><a href="http://wordpress.org/support/">Support Forums</a></li>
									<li><a href="http://wordpress.org/extend/themes/">Themes</a></li>
									<li><a href="http://wordpress.org/news/">WordPress Blog</a></li>
									<li><a href="http://planet.wordpress.org/">WordPress Planet</a></li>
								</ul>

							</div>

						</div>

						<div class="col_one_third col_last">

							<div class="widget clearfix">
								<h4>Recent Posts</h4>

								<div id="post-list-footer">
									<div class="spost clearfix">
										<div class="entry-c">
											<div class="entry-title">
												<h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
											</div>
											<ul class="entry-meta">
												<li>10th July 2014</li>
											</ul>
										</div>
									</div>

									<div class="spost clearfix">
										<div class="entry-c">
											<div class="entry-title">
												<h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
											</div>
											<ul class="entry-meta">
												<li>10th July 2014</li>
											</ul>
										</div>
									</div>

									<div class="spost clearfix">
										<div class="entry-c">
											<div class="entry-title">
												<h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
											</div>
											<ul class="entry-meta">
												<li>10th July 2014</li>
											</ul>
										</div>
									</div>
								</div>
							</div>

						</div>

					</div>

					<div class="col_one_third col_last">

						<div class="widget clearfix" style="margin-bottom: -20px;">

							<div class="row">

								<div class="col-md-6 bottommargin-sm">
									<div class="counter counter-small"><span data-from="50" data-to="15065421" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
									<h5 class="nobottommargin">Total Downloads</h5>
								</div>

								<div class="col-md-6 bottommargin-sm">
									<div class="counter counter-small"><span data-from="100" data-to="18465" data-refresh-interval="50" data-speed="2000" data-comma="true"></span></div>
									<h5 class="nobottommargin">Clients</h5>
								</div>

							</div>

						</div>

						<div class="widget subscribe-widget clearfix">
							<h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
							<div class="widget-subscribe-form-result"></div>
							<form id="widget-subscribe-form" action="include/subscribe.php" role="form" method="post" class="nobottommargin">
								<div class="input-group divcenter">
									<span class="input-group-addon"><i class="icon-email2"></i></span>
									<input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
									<span class="input-group-btn">
										<button class="btn btn-success" type="submit">Subscribe</button>
									</span>
								</div>
							</form>
						</div>

						<div class="widget clearfix" style="margin-bottom: -20px;">

							<div class="row">

								<div class="col-md-6 clearfix bottommargin-sm">
									<a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
								</div>
								<div class="col-md-6 clearfix">
									<a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
										<i class="icon-rss"></i>
										<i class="icon-rss"></i>
									</a>
									<a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
								</div>

							</div>

						</div>

					</div>

				</div> .footer-widgets-wrap end

			</div>-->

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container clearfix">
                                    <h5 class="highlight-me" style="background-color: rgba(255, 255, 0, 0);">Doação - Tags</h5>
                                    <div class="tagcloud">
                                        <a href="#" title="Doação">Doação</a>
                                        <a href="#" title="Animais">Animais</a>
                                        <a href="#" title="Gatos">Gatos</a>
                                        <a href="#" title="Gatos">Filhotes</a>
                                        <a href="#" title="Cachorros">Cachorros</a>
                                        <a href="#" title="Doar">Doar</a>
                                        <a href="#" title="Adotar">Adotar</a>
                                        <a href="#" title="Pet">Pet</a>
                                        <a href="#" title="Gatinho">Gatinho</a>
                                        <a href="#" title="Cachorrinho">Cachorrinho</a>
                                        <a href="#" title="Filhotes">Filhotes</a>
                                        <a href="#" title="Londrina">Londrina</a>
                                        <a href="#" title="Cambé">Cambé</a>
                                        <a href="#" title="Ibporã">Ibporã</a>  
                                    </div>
                                    <br/>
					<div class="col_half">
						Copyrights &copy; DoaPet 2017 Todos os direitos reservados.<br>
                                                <div class="copyright-links"><a href="http://doapet.com.br/termos_pagina.php" title="Termos de uso do site Doa Pet" target="_blank">Termos de Uso</a></div>
					</div>

					<div class="col_half col_last tright">
                                            <div class="fright clearfix">
                                                <a href="https://www.facebook.com/doapet/"  title="Facebook doar animais" target="_blank">
                                                Facebook DoaPet
                                                </a>
                                                <br/>
                                                <i class="icon-envelope2"></i> contato@doapet.com.br <span class="middot"></span> 
                                            </div>
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>
<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="template/js/jquery.js"></script>
	<script type="text/javascript" src="template/js/plugins.js"></script>
	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="template/js/functions.js"></script>
</body>
</html>
