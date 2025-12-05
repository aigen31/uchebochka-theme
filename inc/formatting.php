<?php

function uchebochka_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'uchebochka_excerpt_more');

function uchebochka_excerpt_length($length)
{
  return 35;
}
add_filter('excerpt_length', 'uchebochka_excerpt_length');
