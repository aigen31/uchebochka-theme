<!--- top products -->

<div class="weekly-products">
  <?php
  $title = carbon_get_post_meta(get_option('page_on_front'), 'showcase_title');
  $materials = carbon_get_post_meta(get_option('page_on_front'), 'showcase_materials');
  $materials_ids = [];

  foreach ($materials as $material) {
    $materials_ids[] = $material['material_id'];
  }

  if (!empty($materials) && is_array($materials)) :
  ?>
    <?php if ($title) : ?>
      <h2 class="text-center mb-3"><?php echo esc_html($title); ?></h2>
    <?php else: ?>
      <h2 class="text-center mb-3">Товары недели</h2>
    <?php endif; ?>
    <p class="text-center text-muted mb-4">Здесь подборки новинок, акций и сезонных товаров для вас</p>

    <div class="carousel-container">
      <div class="products-track" id="productsTrack">
        <?php
        $args = [
          'post_type' => 'metodic_post',
          'post__in' => $materials_ids,
          'orderby' => 'post__in',
          'posts_per_page' => count($materials_ids),
        ];
        $query = new WP_Query($args);
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();
            $categories = get_the_terms(get_the_ID(), 'metodic_category');
            $date = get_the_date('d.m.Y');
            $img = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $price = get_post_meta(get_the_ID(), 'price', true);
            $discount = get_post_meta(get_the_ID(), 'without_discount_price', true);
            $free_material = get_post_meta(get_the_ID(), 'free_material', true);
        ?>
            <div class="product-slide">
              <div class="product-card">
                <a href="<?php echo esc_url(get_permalink()); ?>">
                  <div class="product-image">
                    <?php if ($img): ?>
                      <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php else: ?>
                      <div class="s-showcase__noimage"></div>
                    <?php endif; ?>
                    <?php if (function_exists('the_favorites_button')): ?>
                      <?php the_favorites_button(); ?>
                    <?php endif; ?>
                  </div>
                  <div class="price-section">
                    <?php if ($price == 0 || $price == '' || $free_material === '1') : ?>
                      <span class="current-price">Бесплатно</span>
                    <?php else : ?>
                      <span class="current-price"><?php echo esc_html($price); ?> ₽</span>
                      <?php if (!empty($discount)) : ?>
                        <span class="old-price"><?php echo esc_html($discount); ?> ₽</span>
                        <span class="discount">-<?php echo round((($discount - $price) / $discount) * 100); ?>%</span>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                  <a href="<?php echo esc_url(get_permalink()); ?>" class="product-title"><?php echo esc_html(get_the_title()); ?></a>
                  <div class="rating">
                    <?php get_template_part('template-parts/rating-scope'); ?>
                  </div>
                </a>
                <?php if ($free_material !== '1' && ($price !== '' && $price != 0)) : ?>
                  <button class="add-to-cart material-payment" data-id="<?php echo get_the_ID(); ?>" data-url="<?php echo get_permalink(); ?>" data-price="<?php echo $price; ?>" data-title="<?php echo get_the_title(); ?>">
                    В корзину
                  </button>
                <?php else: ?>
                  <a href="<?php echo esc_url(get_permalink()); ?>" class="add-to-cart">
                    Подробнее
                  </a>
                <?php endif; ?>
              </div>
            </div>
        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </div>

      <button class="carousel-control-prev" id="prevBtn">
        <img src="<?php echo get_template_directory_uri(); ?>/img/prev-arr.svg" alt="">
      </button>
      <button class="carousel-control-next" id="nextBtn">
        <img src="<?php echo get_template_directory_uri(); ?>/img/next-arr.svg" alt="">
      </button>
    </div>
  <?php endif; ?>
</div>

<!-- catalog -->