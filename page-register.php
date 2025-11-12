<?php get_header(); ?>
</div>

<!-- TOP END -->

<section class="section-materials">
  <div class="container d-md-flex">

    <?php get_template_part('template-parts/column', 'left'); ?>

    <!-- CENTER COLUMN -->

    <div class="section-materials__materials">
      <div class="bread">
        <?php
        if (function_exists('yoast_breadcrumb')) {
          yoast_breadcrumb();
        } ?>
      </div>

      <h1>Зарегистрироваться</h1>

      <div class="reg-form">
        <?php the_content(); ?>
      </div>
    </div>

    <!-- END CENTER COLUMN -->
  </div>
</section>

<?php get_footer(); ?>