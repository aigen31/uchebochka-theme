<?php
/*
Template Name: Страница автора
*/
get_header();

use Uchebochka\UserWrapper;

$user_login = get_query_var('user_login');

if(!$user_login){
    if(!is_user_logged_in() ){
        wp_redirect(home_url('/'));
        exit;
    }
    $current_user = wp_get_current_user();
    $userWrapper = new UserWrapper($current_user->ID);
    $userLogin = $userWrapper->getUserData()->user_login;
    if(!$userLogin){
        wp_redirect(home_url('/'));
        exit;
    }
    wp_redirect(home_url("/o-sebe/$userLogin/"));
    exit;
}
?>
<section class="section-materials">
    <div class="container d-md-flex">
        <?php get_template_part('template-parts/column', 'left'); ?>
        <?php get_template_part('template-parts/content', 'author');?>
        <?//TODO: get_template_part('template-parts/column', 'subscribe'); ?>
    </div>
</section>
        
<?php get_footer();?>