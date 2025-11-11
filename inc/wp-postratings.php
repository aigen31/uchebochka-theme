<?php

function have_scope(?WP_Post $post = null): bool
{
  if (!function_exists('the_ratings')) {
    return false;
  }
  if (!$post) {
    global $post;
  }
  return isset($post->ratings_score);
}

function get_scope(?WP_Post $post = null): string
{
  if (!function_exists('the_ratings')) {
    return '';
  }
  if (!$post) {
    global $post;
  }
  return $post->ratings_score;
}

function the_scope(?WP_Post $post = null): void
{
  echo get_scope($post);
}
