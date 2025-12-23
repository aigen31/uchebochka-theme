<?php
get_header();
$user_cart_query = uchebka_plugin()->cart_queries()->user_cart_query(get_current_user_id());
?>
</div>

<!-- TOP END -->

<section class="section-materials">
  <div class="container d-md-flex">
    <?php get_template_part('template-parts/column', 'left'); ?>

    <div class="container cart-container">
      <div class="courses-container cart-courses-container">
        <h1 class="courses-title cart-title">Корзина</h1>
        <?php
        $product_ids = $user_cart_query->get_product_ids();
        $products = $user_cart_query->get_query_result();

        $posts = [];
        if (!empty($product_ids)) {
          $query = new WP_Query([
            'post_type' => 'any',
            'post__in' => $product_ids,
            'orderby' => 'ID',
            'order' => 'DESC',
            'posts_per_page' => count($product_ids),
          ]);
          foreach ($query->posts as $index => $post) {
            $post->cart_id = $products[$index]['id'];
            $posts[$post->ID] = $post;
          }
        }
        ?>

        <div id="cart-items">
          <?php
          if (!empty($posts)) :
            foreach ($posts as $post_id => $post):
              $title = get_the_title($post);
              $author_id = $post->post_author;
              $author_name = get_the_author_meta('display_name', $author_id);
              $price = get_post_meta($post->ID, 'price', true);
              $old_price = get_post_meta($post->ID, 'old_price', true);
              $permalink = get_permalink($post);
              $categories = get_the_terms(get_the_ID(), 'metodic_category');
              $string_array_category = "";
              if ($categories && !is_wp_error($categories)) {
                foreach ($categories as $cat) {
                    $string_array_category.= esc_html($cat->name) . " / ";
                }
              }
          ?>
              <div class="document-card cart-item" data-category="<?= $string_array_category ?>">
                <div class="document-info cart-item-info">
                  <a href="<?php echo esc_url($permalink); ?>">
                    <div class="document-title cart-item-title"><?php echo esc_html($title); ?></div>
                  </a>
                  <div class="course-details cart-item-details">
                    <span>Автор: <?php echo esc_html($author_name); ?></span>
                  </div>
                  <div class="paid-materials-card__price-wrapper cart-item-price-wrapper">
                    <span data-price="<?= esc_html($price); ?>" class="paid-materials-card__price cart-item-price"><?php echo esc_html($price); ?> ₽</span>
                    <?php if ($old_price && $old_price > $price): ?>
                      <span class="paid-materials-card__discount-price cart-item-discount-price"><?php echo esc_html($old_price); ?> ₽</span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="document-actions cart-item-actions">
                  <button class="btn btn-edit cart-item-remove" data-product-id="<?php echo intval($post->cart_id); ?>"
                  >Удалить</button>
                </div>
              </div>
            <?php endforeach;
          else:
            ?>
            <div class="cart-empty">
              <p>Ваша корзина пуста.</p>
              <div class="text-center">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-edit cart-empty__btn">Перейти к покупкам</a>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <?php
        if (!empty($posts)) :
        ?>
          <button class="btn btn-view cart-clear-btn">Очистить корзину</button>
        <?php
        endif;
        ?>
        <div class="cart-summary">
          <div class="balance-title cart-summary-title">Итого:</div>
          <div class="balance-amount cart-summary-amount">
            <?php
            $total = 0;
            foreach ($posts as $post) {
              $price = get_post_meta($post->ID, 'price', true);
              $total += number_format(floatval($price), 2, '.', '');
            }
            echo esc_html($total); ?> ₽
          </div>
        </div>
        <div class="cart-actions">
          <?php
          if (!empty($posts)) :
          ?>
            <form class="cart-actions__form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
              <input type="hidden" name="action" value="checkout" required>
              <input type="email" name="email" placeholder="Введите ваш email" required>
              <input type="tel" name="phone" placeholder="Введите ваш телефон" required minlength="18">
              <button class="btn btn-edit cart-checkout-btn">Оформить заказ</button>
            </form>
          <?php
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
get_footer();
?>