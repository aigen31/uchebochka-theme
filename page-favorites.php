<?php
get_header();
?>


<section class="section-materials">
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

      <div id="catalog">
        <?php
        global $wp_query;

        if (!function_exists('get_user_favorites')) {
          echo '<div class="catalog"><p>Плагин "User Favorites" не активирован.</p></div>';
          return;
        }

        $favorites = get_user_favorites(get_current_user_id());

        $wp_query = new WP_Query([
          'post_type' => ['metodic_post', 'curses_post'],
          'post__in' => !empty($favorites) && count($favorites) > 0 ? $favorites : [0],
        ]);

        if ($wp_query->have_posts()): ?>
          <div class="catalog">
            <div class="row g-4">
              <?php
              while ($wp_query->have_posts()):
                $wp_query->the_post();

                // Create a material instance for the current post
                $material = function_exists('uchebka_plugin')
                  ? uchebka_plugin()->methodological_material(get_the_ID())
                  : null;

                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                $permalink = get_permalink();
                $title = get_the_title();

                // Get price information
                $current_price = '';
                $old_price = '';
                $discount_percent = '';
                $is_free = false;

                if ($material) {
                  $price = $material->get_price();
                  $discount = $material->get_without_discount_price();
                  $is_free = $material->is_free_material();

                  if ($is_free) {
                    $current_price = 'Бесплатно';
                  } else {
                    $current_price = $price . ' ₽';
                    if (!empty($discount) && $discount > $price) {
                      $old_price = $discount . ' ₽';
                      $discount_percent = '-' . round((($discount - $price) / $discount) * 100) . '%';
                    }
                  }
                }

                // Check if material is purchased
                $purchased_queries = uchebka_plugin()->purchased_queries();
                $purchased_queries->all_materials_offset_query();
                $is_purchased = in_array(get_the_ID(), $purchased_queries->get_query_result_ids());
              ?>
                <div class="col-md-6 col-12">
                  <div class="product-card">
                    <div class="product-image">
                      <?php if ($image_url): ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                      <?php endif; ?>

                      <?php if (function_exists('the_favorites_button')): ?>
                        <?php the_favorites_button(); ?>
                      <?php endif; ?>
                    </div>

                    <div class="price-section">
                      <span class="current-price"><?php echo esc_html($current_price); ?></span>
                      <?php if (!empty($old_price)): ?>
                        <span class="old-price"><?php echo esc_html($old_price); ?></span>
                        <span class="discount"><?php echo esc_html($discount_percent); ?></span>
                      <?php endif; ?>
                    </div>

                    <a href="<?php echo esc_url($permalink); ?>" class="product-title"><?php echo esc_html($title); ?></a>

                    <div class="rating">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/star1.svg" alt="">
                      <span>4.8</span>
                    </div>

                    <?php if ($is_purchased): ?>
                      <button class="add-to-cart" disabled>Приобретено</button>
                    <?php elseif ($is_free): ?>
                      <a href="<?php echo esc_url($permalink); ?>" class="add-to-cart">Получить бесплатно</a>
                    <?php else: ?>
                      <button class="add-to-cart material-payment" data-id="<?php echo get_the_ID(); ?>">В корзину</button>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endwhile; ?>
              ?>
            </div>
          </div>
        <?php
        else:
          echo '<div class="catalog"><p>Нет постов для отображения.</p></div>';
        endif;

        get_template_part('template-parts/pagination', '', ['wp_query' => $wp_query]);

        wp_reset_query();
        if (!is_page()) {
          exit;
        }
        ?>
      </div>

    </div>

    <!-- END CENTER COLUMN -->
  </div>
</section>
<?php
get_footer();
?>