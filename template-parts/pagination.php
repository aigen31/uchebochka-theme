<?php
if ($args['wp_query']->max_num_pages > 1) :
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $max_pages = $args['wp_query']->max_num_pages;
  $category = isset($_GET['category']) ? $_GET['category'] : null;
  $class = isset($_GET['class']) ? $_GET['class'] : null;
  $type = isset($_GET['type']) ? $_GET['type'] : null;
  $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : null;
  $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : null;
?>
  <div class="pagination">
    <ul>
      <?php
      $base_url = wp_doing_ajax() ? wp_get_referer() : get_pagenum_link(1);
      $base_url = add_query_arg(array('category' => $category, 'class' => $class, 'type' => $type, 'min_price' => $min_price, 'max_price' => $max_price), $base_url);
      for ($i = 1; $i <= $max_pages; $i++) {
        if ($i == $paged) {
          echo '<li class="active"><span>' . $i . '</span></li>';
        } elseif ($i <= 3 || $i > $max_pages - 3 || abs($i - $paged) <= 1) {
          $page_link = add_query_arg('paged', ($i == 1 ? false : $i), $base_url);
          echo '<li><a href="' . esc_url($page_link) . '">' . $i . '</a></li>';
        } elseif ($i == 4 && $paged > 6) {
          echo '<li class="dots">...</li>';
        } elseif ($i == $max_pages - 3 && $paged < $max_pages - 5) {
          echo '<li class="dots">...</li>';
        }
      }
      if ($paged < $max_pages) {
        $next_page = $paged + 1;
        $next_link = add_query_arg('paged', $next_page, $base_url);
        echo '<li><a href="' . esc_url($next_link) . '">Следующая страница <img src="' . get_template_directory_uri() . '/img/next.svg" alt=""></a></li>';
      }
      ?>
    </ul>
  </div>
<?php endif; ?>