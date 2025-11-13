<div class="filter-section" data-filter="<?php echo esc_attr($args['slug']); ?>">
  <div class="filter-title"><?php echo esc_html($args['title']); ?></div>
  <?php
  $child_terms = get_terms([
    'taxonomy' => $args['taxonomy'],
    'parent' => $args['parent_id'],
    'hide_empty' => true
  ]);
  ?>
  <div class="filter-options" id="<?php echo esc_attr($args['slug']); ?>-options">
    <?php foreach ($child_terms as $index => $term) : ?>
      <label class="filter-option <?php echo ($index < $args['max_visible']) ? '' : 'switch hidden'; ?>">
        <div class="custom-checkbox">
          <input
            type="checkbox"
            name="<?php echo $args['slug']; ?>[]"
            value="<?php echo esc_attr($term->slug); ?>"
            <?php
            if (!empty($_GET[$args['slug']]) && is_array($_GET[$args['slug']])) {
              echo in_array($term->slug, $_GET[$args['slug']]) ? 'checked' : '';
            }
            ?>>
          <span class="checkmark"></span>
        </div>
        <span><?php echo esc_html($term->name); ?></span>
      </label>
    <?php endforeach; ?>
  </div>
  <?php if (count($child_terms) > $args['max_visible']) : ?>
    <button class="show-more" data-target="<?php echo esc_attr($args['slug']); ?>-options">Показать еще</button>
  <?php endif; ?>
</div>