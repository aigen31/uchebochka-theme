<?php

function ajax_filter_posts()
{
  get_template_part('template-parts/catalog');
}

add_action('wp_ajax_filter_posts', 'ajax_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_posts');
