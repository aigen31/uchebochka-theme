<?php get_header(); ?>

<section class="articles-page">
  <div class="container">
    <div class="bread">
      <?php
      if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb();
      } ?>
    </div>

    <h1>Роспотребнадзор с помощью ИИ выявил 65 работ
      на ЕГЭ, в которых не совпадает почерк</h1>
  </div>
  <div class="container d-md-flex">
    <!-- CENTER COLUMN -->

    <div class="article">

      <!-- article body -->

      <div class="article-body">
        <?php the_content(); ?>
      </div>

      <!-- comments -->

      <div class="comments">
        <h4>Комментарии</h4>

        <?php
        if (comments_open() || get_comments_number()) {
          comments_template();
        } else {
          echo '<p>Комментарии закрыты.</p>';
        }
        ?>
      </div>


    </div>



    <!-- END CENTER COLUMN -->




  </div>
</section>

<?php get_footer(); ?>