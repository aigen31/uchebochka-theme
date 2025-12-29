<?php
/**
 * Template Name: Single Robototehnika
 * Template Post Type: metodic_post
 * 
 * Single material page for robototehnika category
 * Uses template-parts/single-robototehnika.php
 * 
 * @package uchebochka
 */

// Check if this post belongs to robototehnika category
$is_robototehnika = false;
$categories = get_the_terms(get_the_ID(), 'metodic_category');

if ($categories && !is_wp_error($categories)) {
    foreach ($categories as $category) {
        if ($category->slug === 'robototehnika') {
            $is_robototehnika = true;
            break;
        }
    }
}

// If not robototehnika category, use default single template
if (!$is_robototehnika) {
    get_template_part('single');
    return;
}

// Track viewer for social proof
if (function_exists('uchebka_plugin')) {
    uchebka_plugin()->ai_social_proof()->track_viewer(get_the_ID());
}

// Load the robototehnika single template
get_template_part('template-parts/single-robototehnika');
