<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package uchebochka
 */

get_header();
?>
</div>

<!-- TOP END -->

	<?php
	switch (get_post_type()) {
		case 'metodic_post':
			get_template_part('template-parts/single-metodic-post');
			break;
		case 'post':
			get_template_part('template-parts/single-post');
		default:
			return;
	}
	?>

<?php
get_footer();
