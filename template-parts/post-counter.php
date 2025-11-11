<div class="section-materials__total">
  <?php
  $posts = get_posts([
    'post_type' => $args['post_type'] ?? ['metodic_post'],
    'post_status' => 'publish',
    'numberposts' => -1,
  ]);

  $count_posts = count($posts);

  echo 'Всего: <span class="paid-materials-search__count">' . $count_posts . '</span> ' . $args['postfix'];
  ?>
</div>