<?php
global $wp_query;

if (have_posts()): ?>
  <div class="catalog">
    <div class="row g-4">
      <?php
      while (have_posts()):
        the_post();

        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
        $title = get_the_title();
        $permalink = get_permalink();
      ?>
        <div class="col-md-6 col-12">
          <div class="product-card">
            <div class="product-image">
              <?php if ($image_url): ?>
                <a href="<?php echo esc_url($permalink); ?>">
                  <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                </a>
              <?php endif; ?>
            </div>

            <a href="<?php echo esc_url($permalink); ?>" class="product-title"><?php echo esc_html($title); ?></a>

            <p class="product-except"><?php echo esc_html(get_the_excerpt()); ?></p>

            <a href="<?php echo esc_url($permalink); ?>" class="btn btn--accent">Далее</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
<?php
else:
  echo '<div class="catalog"><p>Нет постов для отображения.</p></div>';
endif;

get_template_part('template-parts/pagination', '', ['wp_query' => $wp_query]);
