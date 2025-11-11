<?php

/**
 * Template Name: Страница без подложки
 *
 * @package uchebochka
 */

get_header();
?>

<section class="section-materials">
	<div class="container d-md-flex">

		<?php get_template_part('template-parts/column', 'left'); ?>

		<!-- CENTER COLUMN -->

		<div class="section-materials__materials">

			<div class="bread">
				<?php
				if (function_exists('yoast_breadcrumb')) {
					yoast_breadcrumb();
				} ?>
			</div>

			<h1><?php the_title(); ?></h1>

			<?php if (has_post_thumbnail()) : ?>
				<div class="about__img">
					<?php the_post_thumbnail('medium'); ?>
				</div>
			<?php endif; ?>

			<?php the_content(); ?>
		</div>

		<!-- END CENTER COLUMN -->
	</div>
</section>

<?php
get_footer();
