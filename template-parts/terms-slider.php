<?php
$child_terms = get_terms([
  'taxonomy' => $args['taxonomy'],
  'parent' => $args['parent_id'],
  'hide_empty' => true
]);
?>
<div class="sections-wrapper" id="sectionsWrapper">
  <?php foreach ($child_terms as $term): ?>
    <a href="<?php echo esc_url('/?category[0]=' . esc_attr($term->slug)); ?>" class="section-item"><?php echo esc_html($term->name); ?></a>
  <?php endforeach; ?>
</div>