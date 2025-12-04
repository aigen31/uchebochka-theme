<?php
/**
 * uchebochka Theme Customizer
 *
 * @package uchebochka
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uchebochka_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'uchebochka_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'uchebochka_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'uchebochka_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function uchebochka_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function uchebochka_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uchebochka_customize_preview_js() {
	wp_enqueue_script( 'uchebochka-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'uchebochka_customize_preview_js' );

/**
 * Remove word from h1
 */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
 
/**
 * Change h1 only in wp_footer
 */
add_action('wp_footer', function() {
    ob_start(function($footer_content) {
        // in wp-link
        return preg_replace(
            '/(<div[^>]*id="wp-link-wrap"[^>]*>.*?)<h1(\s[^>]*)?>(.*?)<\/h1>(.*?<\/div>)/is',
            '$1<h2$2>$3</h2>$4',
            $footer_content
        );
    });
}, 1);

add_action('wp_footer', function() {
    if (ob_get_length()) {
        ob_end_flush();
    }
}, 99999);