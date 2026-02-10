<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package uchebochka
 */

get_header();
?>

<section class="section-hero">
  <div class="container">
    <div class="section-hero__row">
      <div class="section-hero__col section-hero__col--left">
        <h1 class="h1 section-hero__h1">
          <?php printf( esc_html( 'Результаты поиска: %s', 'uchebochka' ), '<span>' . get_search_query() . '</span>' ); ?>
        </h1>
      </div>
    </div>
  </div>
</section>
</div>


<section class="section-materials" id="materialsSection">
  <div class="container d-md-flex">

    <?php get_template_part('template-parts/column-left'); ?>

    <!-- CENTER COLUMN -->

    <div class="section-materials__materials">

      <!-- smart search -->

      <div class="materials">
        <?php get_template_part('template-parts/search'); ?>

        <?php get_template_part('template-parts/post-counter', '', [
          'postfix' => 'методических разработок',
        ]); ?>
      </div>

      <!-- categories -->

      <div class="categories">
        <div class="sections-container">
          <h2 class="mb-4">Разделы</h2>

          <div class="gradient-overlay"></div>

          <!-- <div class="sections-wrapper" id="sectionsWrapper">
            <a href="#" class="section-item">История</a>
            <a href="#" class="section-item">Экономика</a>
            <a href="#" class="section-item">Русский язык</a>
            <a href="#" class="section-item">ОБЖ</a>
            <a href="#" class="section-item">Химия</a>
            <a href="#" class="section-item">География</a>
            <a href="#" class="section-item">Иностранные языки</a>
            <a href="#" class="section-item">Математика</a>
          </div> -->

          <?php get_template_part('template-parts/terms-slider', '', [
            'taxonomy' => 'metodic_category',
            'parent_id' => 11,
          ]); ?>

          <div class="slider-container">
            <div class="slider-track"></div>
            <div class="slider-thumb" id="sliderThumb"></div>
          </div>
        </div>
      </div>

      <div id="catalog">
        <?php ajax_filter_posts(); ?>
      </div>

    </div>

    <!-- END CENTER COLUMN -->

    <?php get_template_part('template-parts/column-right'); ?>

    <!-- END ROW -->
  </div>
</section>
<?php
get_footer();
?>
