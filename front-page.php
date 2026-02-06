<?php
get_header();
?>

<section class="section-hero">
  <div class="container">
    <div class="section-hero__row">
      <div class="section-hero__col section-hero__col--left">
        <h1 class="h1 section-hero__h1">
          Маркетплейс<br>
          методических<br>
          разработок
        </h1>

        <div class="section-hero__items">
          <div class="section-hero__column">
            <div class="section-hero__item">
              <p class="section-hero__item--title">
                Педагоги и эксперты
              </p>

              <p class="section-hero__item--text">
                Покупайте материалы для занятий,<br>
                чтобы сделать их интереснее<br>
                и сэкономить время
              </p>
            </div>

            <a href="/#materialsSection" class="btn section-hero__btn">Перейти в каталог</a>
          </div>

          <div class="section-hero__column">
            <div class="section-hero__item">
              <p class="section-hero__item--title">
                Авторы материалов
              </p>

              <p class="section-hero__item--text">
                Размещайте свои разработки<br>
                и получайте 50% от продаж - <br>
                комфортный пассивный доход
              </p>
            </div>

            <a href="/create-material/" class="btn section-hero__btn section-hero__btn--underline">Разместить материал</a>
          </div>
        </div>
      </div>
      <div class="section-hero__col section-hero__col--right">
        <img src="<?php echo get_template_directory_uri(); ?>/img/promo.png" alt="" class="section-hero__image">
        <div class="promo-menu">
          <ul>
            <li><a href="/methodical-materials/matematika/">Математика</a></li>
            <li><a href="/methodical-materials/anglijskij-yazyk/">Английский язык</a></li>
            <li><a href="/methodical-materials/robototehnika/">Робототехника</a></li>
            <li><a href="/methodical-materials/geografiya/">География</a></li>
            <li><a href="/methodical-materials/russkij-yazyk/">Русский язык</a></li>
            <li><a href="/methodical-materials/programmirovanie-category/">Программирование</a></li>
          </ul>
        </div>
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

      <!-- banner -->

      <div class="section-materials__banner">
        <h2 class="section-materials__banner-title">Зарабатывайте на своих методических разработках!</h2>

        <p class="section-materials__banner-text">Создавайте, размещайте и продавайте свои работы на
          образовательном
          маркетплейсе «Учебочка»</p>

        <a href="#" class="btn btn--icon section-materials__banner-link">
          <span>Подробнее</span>
          <img src="<?php echo get_template_directory_uri(); ?>/img/button/link.svg" alt="">
        </a>
      </div>

      <div id="catalog">
        <?php get_template_part('template-parts/weekly-products'); ?>
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