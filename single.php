<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package uchebochka
 */

// Check for robototehnika category for metodic_post
if (get_post_type() === 'metodic_post') {
	$categories = get_the_terms(get_the_ID(), 'metodic_category');
	$is_robototehnika = false;
	
	if ($categories && !is_wp_error($categories)) {
		foreach ($categories as $category) {
			if ($category->slug === 'robototehnika') {
				$is_robototehnika = true;
				break;
			}
		}
	}
	
	if ($is_robototehnika) {
		// Track viewer for social proof
		if (function_exists('uchebka_plugin')) {
			uchebka_plugin()->ai_social_proof()->track_viewer(get_the_ID());
		}
		
		// Load robototehnika template (includes own header/footer)
		get_template_part('template-parts/single-robototehnika');
		return;
	}
}

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
