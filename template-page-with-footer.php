Template Name: Страница с футером (подвалом)uchebochka<?php

																											/**
																											 * Template Name: Страница с футером (подвалом)
																											 *
																											 * @package uchebochka
																											 */

																											get_header();
																											?>
</div>

<!-- TOP END -->

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

				<div class="d-flex">
					<div class="img">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="">
					</div>
					<div class="text">С уважением, команда Учебочки!</div>
				</div>
			</div>
		</div>

		<!-- END CENTER COLUMN -->
	</div>
</section>

<?php
get_footer();
