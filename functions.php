<?php

/**
 * Template loading functions
 */
require get_template_directory() . '/inc/templates.php';

/**
 * Theme options initialization file.
 */
require get_template_directory() . '/inc/theme-init.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Ultimate Members integration.
 */
require get_template_directory() . '/inc/ultimate-members.php';

/**
 * User functions
 */
require get_template_directory() . '/inc/user.php';

/**
 * WP Post Ratings Plugin functions
 */
require get_template_directory() . '/inc/wp-postratings.php';

/**
 * Profile Rating implementation
 */
require get_template_directory() . '/inc/profile-rating.php';

/**
 * Support Candy extension functions
 */
require get_template_directory() . '/inc/support-candy.php';