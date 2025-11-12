<?php
get_header();
?>
</div>

<!-- TOP END -->

<section class="section-materials">
  <div class="container d-md-flex">

    <?php get_template_part('template-parts/column-left'); ?>

    <!-- CENTER COLUMN -->

    <div class="section-materials__materials">

      <div class="materials">
        <?php get_template_part('template-parts/search'); ?>
      </div>

      <h1><?php single_cat_title(); ?></h1>

      <div id="catalog">
        <?php get_template_part('template-parts/loop'); ?>
      </div>
    </div>
  </div>
</section>
<?php
get_footer();
?>