<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uchebochka
 */

?>

<!DOCTYPE html>
<html lang="ru-ru" dir="ltr" itemscope itemtype="https://schema.org/WebPage" prefix="og:http://ogp.me/ns#" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'>


	<!-- General -->
	<meta name="referrer" content="strict-origin" />

	<!-- Microsoft -->
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="msapplication-starturl" content="/" />
	<meta name="msapplication-TileColor" content="#f0c000" />
	<meta name="msapplication-config" content="browserconfig.xml" />

	<!-- iOS -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#f0c000" />

	<!-- Android -->
	<meta name="theme-color" content="#f0c000" />
	<meta name="color-scheme" content="light" />

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

	<style>
		/* Critical CSS */
	</style>

	<?php wp_head(); ?>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function(m, e, t, r, i, k, a) {
			m[i] = m[i] || function() {
				(m[i].a = m[i].a || []).push(arguments)
			};
			m[i].l = 1 * new Date();
			for (var j = 0; j < document.scripts.length; j++) {
				if (document.scripts[j].src === r) {
					return;
				}
			}
			k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
		})
		(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		ym(102088441, "init", {
			clickmap: true,
			trackLinks: true,
			accurateTrackBounce: true,
			webvisor: true,
			ecommerce: "dataLayer"
		});
	</script>
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/102088441" style="position:absolute; left:-9999px;" alt="" /></div>
	</noscript>
	<!-- /Yandex.Metrika counter -->
</head>

<body <?php body_class('main'); ?>>
	<div class="top">
		<header class="header-main">
			<div class="container header-main__container">
				<div class="header-main__wrapper d-md-flex align-items-md-center">
					<a href="/" class="logo header-main__logo">
						<img src="<?php echo get_template_directory_uri(); ?>/img/header/logo.svg" alt="">
					</a>

					<div class="header-main__menu">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container'      => null,
							)
						);
						?>
					</div>

					<div class="header-main__buttons">
						<div class="btn btn--icon header-main__support-btn">
							<span>Техническая поддержка</span>
							<div class="header-main__support-icons">
								<a href="https://vk.me/public219902120">
									<img src="<?php echo get_template_directory_uri(); ?>/img/socials/vk.svg" alt="">
								</a>
								<a href="https://t.me/uchebochka_support">
									<img src="<?php echo get_template_directory_uri(); ?>/img/socials/tg.svg" alt="">
								</a>
							</div>
						</div>

						<div class="links d-flex">
							<a href="/favorites">
								<img src="<?php echo get_template_directory_uri(); ?>/img/star-top.svg" alt="">
							</a>
							<a href="/cart">
								<img src="<?php echo get_template_directory_uri(); ?>/img/cart2.svg" alt="">
								<span class="count cart__count"><?php echo uchebka_plugin()->cart_queries()->get_products_count(get_current_user_id()); ?></span>
							</a>
							<a href="/lichnyj-kabinet">
								<img src="<?php echo get_template_directory_uri(); ?>/img/lk.svg" alt="">
								<img src="<?php echo get_template_directory_uri(); ?>/img/download.svg" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<header class="mob">
			<div class="container">
				<div class="d-flex justify-content-between align-items-center">
					<div class="logo">
						<a href="/">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="">
						</a>
					</div>
					<div class="pad">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container'      => null,
							)
						);
						?>
					</div>
					<div class="burg">
						<img src="<?php echo get_template_directory_uri(); ?>/img/burger.svg" alt="">
					</div>
				</div>
			</div>
		</header>

		<!--- burger menu -->

		<div class="burger-menu" style="display:none;">
			<div class="container">
				<div class="item">
					<div class="close-burger">
						<img src="<?php echo get_template_directory_uri(); ?>/img/close-menu.svg" alt="">
					</div>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container'      => null,
						)
					);
					?>

					<ul>
						<li><a href="/register">Регистрация</a></li>
						<li><a href="/login">Вход</a></li>
						<li><a href="/tehnicheskaya-podderzhka">Техническая помощь</a></li>
					</ul>

					<div class="header-main__support-icons">
						<a href="https://vk.me/public219902120" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/socials/vk.svg" alt=""></a>
						<a href="https://t.me/uchebochka_support" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/socials/tg.svg" alt=""></a>
					</div>
				</div>
			</div>
		</div>

		<div class="bottom-menu mob">
			<ul>
				<li><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/home.svg" alt=""></a></li>
				<li class="filter-call"><a><img src="<?php echo get_template_directory_uri(); ?>/img/set2.svg" alt=""></a></li>
				<li class="lk-button"><a href="/lichnyj-kabinet"><img src="<?php echo get_template_directory_uri(); ?>/img/lk.svg" alt=""></a></li>
				<li><a href="/favorites"><img src="<?php echo get_template_directory_uri(); ?>/img/star-top.svg" alt=""></a></li>
				<li><a href="/cart">
						<img src="<?php echo get_template_directory_uri(); ?>/img/cart2.svg" alt="">
						<span class="count cart__count"><?php echo uchebka_plugin()->cart_queries()->get_products_count(get_current_user_id()); ?></span>
					</a></li>
			</ul>
		</div>