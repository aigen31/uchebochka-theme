<div class="item">
  <h4><?php echo esc_html($args['title']); ?></h4>
  <div class="inputs">
    <?php
    $categories = get_categories(array(
      'taxonomy' => $args['taxonomy'],
      'parent' => $args['parent'],
      'hide_empty' => false
    ));
    $total_categories = count($categories);
    for ($i = 0; $i < min(3, $total_categories); $i++) {
    ?>
      <label>
        <input type="checkbox" name="post_<?php echo $args['slug']; ?>[]" value="<?php echo esc_attr($categories[$i]->term_id); ?>"
          <?php
          if (!empty($_GET['post_' . $args['slug']]) && is_array($_GET['post_' . $args['slug']])) {
            echo in_array($categories[$i]->term_id, $_GET['post_' . $args['slug']]) ? 'checked' : '';
          }
          ?>>
        <span></span><?php echo esc_html($categories[$i]->name); ?>
      </label>
    <?php } ?>

    <?php if ($total_categories > 3) { ?>
      <div class="inputs-hid">
        <?php for ($i = 3; $i < $total_categories; $i++) { ?>
          <label>
            <input type="checkbox" name="post_<?php echo $args['slug']; ?>[]" value="<?php echo esc_attr($categories[$i]->term_id); ?>"
              <?php
              if (!empty($_GET['post_' . $args['slug']]) && is_array($_GET['post_' . $args['slug']])) {
                echo in_array($categories[$i]->term_id, $_GET['post_' . $args['slug']]) ? 'checked' : '';
              }
              ?>>
            <span></span><?php echo esc_html($categories[$i]->name); ?>
          </label>
        <?php } ?>
      </div>
      <div class="but">
        <button type="button">Показать ещё</button>
      </div>
    <?php } ?>
  </div>
</div>