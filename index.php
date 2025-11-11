<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

		<div class="section-materials__materials">
			<?php
			$thumbnail = get_the_post_thumbnail_url();
			if ($thumbnail) { ?>
				<div class="post__thumbnail-wrapper">
					<img class="gallery-top__image" src="<?php echo esc_url($thumbnail) ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
				</div>
			<?php } ?>
			<div class="post__body">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
