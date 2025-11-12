<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package uchebochka
 */

get_header();
?>
</div>

<!-- TOP END -->

<section class="section-materials">
  <div class="container d-md-flex">

    <?php get_template_part('template-parts/column', 'left'); ?>

    <div class="section-materials__materials">
      <h1 class="page-title">404 - Страница не найдена</h1>
      <p>Извините, но запрашиваемая вами страница не существует, была удалена, изменено её название или временно недоступна.</p>
      <p>Пожалуйста, попробуйте воспользоваться поиском или перейти на <a href="<?php echo esc_url(home_url('/')); ?>">главную страницу</a>.</p>
    </div>
  </div>
</section>

<?php
get_footer();
