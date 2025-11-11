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

	<link rel="canonical" href="https://moderntemplate.site/" />
	<link rel="amphtml" href="https://moderntemplate.site/amp/index.html" />
	<link rel="icon" type="image/png" href="./img/icons/64x64.png" />
	<link rel="manifest" href="./manifest.json" />
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- General -->
	<meta name="referrer" content="strict-origin" />

	<meta itemprop="name" content="HTML Template" />
	<meta itemprop="description" content="Modern HTML Starter Template" />
	<meta itemprop="image" content="./img/icons/128x128.png" />

	<!-- Microsoft -->
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="msapplication-starturl" content="/" />
	<meta name="msapplication-tooltip" content="Modern HTML Starter Template" />
	<meta name="msapplication-TileColor" content="#3c3c3c" />
	<meta name="msapplication-config" content="browserconfig.xml" />

	<!-- Facebook -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://moderntemplate.site/" />
	<meta property="og:title" content="HTML Template" />
	<meta property="og:description" content="Modern HTML Starter Template" />
	<meta property="og:image" content="./img/icons/600x600.png" />
	<meta property="og:locale" content="en_US" />

	<!-- Twitter -->
	<meta name="twitter:card" content="app" />
	<meta name="twitter:title" content="HTML Template" />
	<meta name="twitter:description" content="Modern HTML Starter Template" />
	<meta name="twitter:url" content="https://moderntemplate.site/" />
	<meta name="twitter:image" content="./img/icons/512x512.png" />

	<!-- iOS -->
	<meta name="apple-mobile-web-app-title" content="HTML Template" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="#3c3c3c" />
	<link rel="apple-touch-icon" href="./img/icons/512x512.png" />

	<!-- Android -->
	<meta name="theme-color" content="#f0f0f0" />
	<meta name="color-scheme" content="light" />
	<meta name="mobile-web-app-capable" content="yes" />

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

	<style>
		/* Critical CSS */
	</style>

	<?php wp_head(); ?>
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
								<a href="https://t.me/ucheb_mat">
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
							<a href="/create-material">
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
						<a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/socials/vk.svg" alt=""></a>
						<a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/socials/tg.svg" alt=""></a>
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