<?php
global $wp_query;

// Use the new Material Query class for getting posts
if (function_exists('uchebka_plugin')) {
  $material_query = uchebka_plugin()->material_wp_query();
  $wp_query = $material_query->filter_materials_query()->get_wp_query();
} else {
  // Fallback if plugin is not loaded
  $wp_query = new WP_Query([
    'post_type' => ['metodic_post', 'curses_post'],
    'post_status' => 'publish',
    'posts_per_page' => 10
  ]);
}

if ($wp_query->have_posts()): ?>
  <div class="catalog" id="catalog">
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
     
        $string_array_category = "";
        $categories = get_the_terms(get_the_ID(), 'metodic_category');
        if ($categories && !is_wp_error($categories)) {
          foreach ($categories as $cat) {
              $string_array_category.= esc_html($cat->name) . " / ";
          }
        }
  

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
        $purchased_queries = uchebka_plugin()->purchased_queries()->user_materials_offset_query(get_current_user_id());
        $is_purchased = in_array(get_the_ID(), $purchased_queries->get_query_result_ids());
      ?>
        <div class="col-md-6 col-12">
          <div class="product-card" data-category="<?=$string_array_category?>">
            <div class="product-image">
              <?php if ($image_url): ?>
                <a href="<?php echo esc_url($permalink); ?>">
                  <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                </a>
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


            <div class="rating-article">
              <?php get_template_part('template-parts/rating-scope'); ?>
            </div>

            <?php if ($is_purchased): ?>
              <button class="add-to-cart" disabled>Приобретено</button>
            <?php elseif ($is_free): ?>
              <a href="<?php echo esc_url($permalink); ?>" class="add-to-cart">Получить бесплатно</a>
            <?php else: ?>
              <div class="catalog-buttons">
                <button class="add-to-cart material-instant-purchase" 
                  data-product-id="<?php echo get_the_ID(); ?>"
                  data-product-title="<?php echo esc_attr($title); ?>"
                  data-product-price="<?php echo esc_attr($material ? number_format($material->get_price(), 0, '', ' ') . ' ₽' : ''); ?>">Купить</button>
                <button class="add-to-cart add-to-cart--secondary material-payment" data-product-id="<?php echo get_the_ID(); ?>">В корзину</button>
              </div>
            <?php endif; ?>

            <?php echo get_template_part('template-parts/modal', ''); ?>
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

wp_reset_query();
wp_reset_postdata();
if (wp_doing_ajax()) {
  exit;
}
?>