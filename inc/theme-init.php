<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
  Container::make('post_meta', 'Вопрос-ответ')
    ->where('post_id', get_page_by_path('vopros-otvet')->ID)
    ->add_fields([
      Field::make('complex', 'faq', 'Вопросы и ответы')
        ->set_layout('tabbed-horizontal')
        ->add_fields([
          Field::make('text', 'question', 'Вопрос'),
          Field::make('rich_text', 'answer', 'Ответ'),
        ])
    ]);
  Container::make('post_meta', 'Витрина товаров')
    ->where('post_id', get_option('page_on_front'))
    ->add_fields([
      Field::make('text', 'showcase_title', 'Заголовок витрины')
        ->set_attribute('maxLength', 255),
      Field::make('complex', 'showcase_materials', 'Добавить товар')
        ->set_layout('tabbed-horizontal')
        ->add_fields([
          Field::make('text', 'material_id', 'ID материала')
            ->set_attribute('type', 'number'),
        ])
    ]);
  Container::make('user_meta', 'Информация о пользователе')
    ->add_fields([
      Field::make('complex', 'advanced_training', 'Повышения квалификации')
        ->add_fields([
          Field::make('text', 'name', 'Название'),
          Field::make('text', 'organization', 'Организация или спикер'),
          Field::make('text', 'year', 'год')
            ->set_attribute('max', date('Y'))
            ->set_attribute('min', '1900')
            ->set_attribute('type', 'number')
        ]),
      Field::make('complex', 'work', 'Места работы')
        ->add_fields([
          Field::make('text', 'organization', 'Организация'),
          Field::make('text', 'specialization', 'Специальность'),
          Field::make('text', 'year', 'Год')
            ->set_attribute('max', date('Y'))
            ->set_attribute('min', '1900')
            ->set_attribute('type', 'number'),
          Field::make('text', 'experience', 'Стаж работы')
            ->set_attribute('max', '100')
            ->set_attribute('type', 'number'),
        ]),

    ],);
}

// add_action('after_setup_theme', 'crb_load');
// function crb_load()
// {
//   require_once(__DIR__ . '/../vendor/autoload.php');
//   \Carbon_Fields\Carbon_Fields::boot();
// }

/**
 * uchebochka functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uchebochka
 */

if (! defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uchebochka_setup()
{
  /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on uchebochka, use a find and replace
		* to change 'uchebochka' to the name of your theme in all the template files.
		*/
  load_theme_textdomain('uchebochka', get_template_directory() . '/languages');

  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
  add_theme_support('title-tag');

  /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
  add_theme_support('post-thumbnails');

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(
    array(
      'menu-1' => esc_html__('Primary', 'uchebochka'),
      'footer' => esc_html__('Footer Menu', 'uchebochka'),
    )
  );

  /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'uchebochka_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uchebochka_widgets_init()
{
  register_sidebar(
    array(
      'name'          => esc_html__('Sidebar', 'uchebochka'),
      'id'            => 'sidebar-1',
      'description'   => esc_html__('Add widgets here.', 'uchebochka'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'uchebochka_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function uchebochka_scripts()
{
  // Не загружать Bootstrap стили на страницах материалов робототехники
  $is_robototehnika = (is_singular('metodic_post') && has_term('robototehnika', 'metodic_category')) || (is_tax('metodic_category', 'robototehnika'));
  
  
  if (!$is_robototehnika) {
    wp_enqueue_style('uchebochka-bootstrap-reboot', get_template_directory_uri() . '/src/libs/bootstrap/css/bootstrap-reboot.css', array());
    wp_enqueue_style('uchebochka-bootstrap-grid', get_template_directory_uri() . '/src/libs/bootstrap/css/bootstrap-grid.css', array());
    wp_enqueue_style('uchebochka-bootstrap', get_template_directory_uri() . '/src/libs/bootstrap/css/bootstrap.min.css', array());
  }
  wp_enqueue_style('uchebochka-style', get_stylesheet_uri(), array(), _S_VERSION);
  wp_enqueue_style('uchebochka-main-style', get_template_directory_uri() . '/src/css/style.css', $is_robototehnika ? [] : array('uchebochka-bootstrap-reboot', 'uchebochka-bootstrap-grid', 'uchebochka-bootstrap'), _S_VERSION);
  wp_enqueue_style('uchebochka-tablet-style', get_template_directory_uri() . '/src/css/tablet.css', ['uchebochka-main-style'], _S_VERSION);
  wp_enqueue_style('uchebochka-mobile-style', get_template_directory_uri() . '/src/css/mobile.css', ['uchebochka-tablet-style'], _S_VERSION);

  wp_style_add_data('uchebochka-style', 'rtl', 'replace');
  wp_enqueue_script('jquery');
  wp_enqueue_script('uchebochka-bootstrap-bundle', get_template_directory_uri() . '/src/js/bootstrap.bundle.min.js', array('jquery'), '5.1.3', true);
  wp_enqueue_script('jquery-mask', get_template_directory_uri() . '/src/js/mask.js', array('jquery'), _S_VERSION, true);
  wp_enqueue_script('uchebochka-main', get_template_directory_uri() . '/src/js/main.js', array('jquery'), _S_VERSION, true);
  wp_enqueue_script_module('uchebochka-app', get_template_directory_uri() . '/src/js/app.js');
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_localize_script('uchebochka-main', 'ajax_filter_params', array(
    'ajax_url' => admin_url('admin-ajax.php')
  ));

  wp_localize_script('uchebochka-main', 'uchebochka_user', array(
    'is_logged_in' => is_user_logged_in(),
    'id'         => get_current_user_id()
  ));

  if (function_exists('uchebka_plugin')) {
    wp_localize_script('uchebochka-main', 'uchebochka_vars', array(
      'rest_url' => esc_url(rest_url()),
      'nonce'    => wp_create_nonce('wp_rest'),
      'rest_route' => 'uchebka/v1',
      'wp_login' => esc_url(site_url('/wp-login.php')),
    ));
  }
}
add_action('wp_enqueue_scripts', 'uchebochka_scripts');
