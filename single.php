<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package uchebochka
 */

get_header();

$isEdit = filter_input(
    INPUT_GET,
    'edit',
    FILTER_VALIDATE_BOOLEAN,
    ['flags' => FILTER_NULL_ON_FAILURE]
);
?>
</div>

<!-- TOP END -->

	<?php
	switch (get_post_type()) {
		case 'metodic_post':
			if($isEdit){
				get_template_part('template-parts/single-metodic-post-2');
			}else{
				get_template_part('template-parts/single-metodic-post');
			}
			break;
		case 'post':
			get_template_part('template-parts/single-post');
		default:
			return;
	}
	?>

<?php
get_footer();
