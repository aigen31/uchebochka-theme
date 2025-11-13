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

        <?php get_template_part('template-parts/post-counter', '', [
          'postfix' => 'методических разработок',
        ]); ?>
      </div>

      <h1>Блог</h1>

      <!-- categories -->

      <div id="catalog">
        <?php get_template_part('template-parts/loop'); ?>
      </div>

    </div>

    <!-- END CENTER COLUMN -->
  </div>
</section>
<?php
get_footer();
?>