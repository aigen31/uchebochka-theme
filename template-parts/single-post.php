<?php get_header(); ?>

<section class="articles-page">
  <div class="container">
    <div class="bread">
      <?php
      if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb();
      } ?>
    </div>

    <?php the_title('<h1>', '</h1>'); ?>
  </div>
  <div class="container d-md-flex">
    <!-- CENTER COLUMN -->

    <div class="article">

      <!-- meta info -->

      <div class="d-flex justify-content-between align-items-center">
        <div class="avatar">
          <div class="img">
            <img src="img/ava.png" alt="">
          </div>
          <div class="text">
            <div class="name">Иванов Иван</div>
            <div class="dol">Место работы</div>
          </div>
        </div>
        <div class="meta-art">
          <div class="read">
            <img src="img/time.svg" alt="">
            <span>Время чтения: <span id="timeread">1 минута</span></span>
          </div>
          <!-- <div class="d-flex">
                  <div class="item">
                      <img src="img/see.svg" alt="">
                      <span>61</span>
                  </div>
                  <div class="item">
                      <img src="img/chat2.svg" alt="">
                      <span>0</span>
                  </div>
                  <div class="item">
                      <img src="img/cal.svg" alt="">
                      <span>09.07.2025</span>
                  </div>
              </div>-->
        </div>
      </div>

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