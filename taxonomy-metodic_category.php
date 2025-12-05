<?php
get_header();
?>
</div>

<!-- TOP END -->

<section class="section-materials">
  <div class="container d-md-flex">

    <?php get_template_part('template-parts/column', 'left'); ?>

    <!-- CENTER COLUMN -->

    <div class="section-materials__materials">

      <!-- smart search -->

      <div class="materials">
        <?php get_template_part('template-parts/search'); ?>
      </div>

      <div class="bread">
        <div class="bread">
          <span>
            <span><a href="/">Главная страница</a></span>
            / 
            <span><a href="/methodical-materials/">Методические разработки</a></span>
            / 
            <span class="breadcrumb_last" aria-current="page"><?php the_archive_title(); ?></span>
          </span>      
        </div>
      </div>

      <h1><?php the_archive_title(); ?></h1>

      <!-- categories -->

      <div id="catalog">
        <?php get_template_part('template-parts/loop', 'methodical'); ?>
      </div>

    </div>

    <?php get_template_part('template-parts/column-right'); ?>

    <!-- END CENTER COLUMN -->
  </div>
</section>
<?php
get_footer();
?>