<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

			<div class="about">
				<?php the_content(); ?>
			</div>


		</div>



		<!-- END CENTER COLUMN -->
	</div>
</section>

<?php
get_footer();
