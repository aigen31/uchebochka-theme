<?php
$child_terms = get_terms([
  'taxonomy' => $args['taxonomy'],
  'parent' => $args['parent_id'],
  'hide_empty' => true
]);
?>
<div class="sections-wrapper" id="sectionsWrapper">
  <?php foreach ($child_terms as $term): ?>
    <a href="/?category[0]=<?php echo esc_url(esc_attr($term->slug)); ?>#catalog" class="section-item"><?php echo esc_html($term->name); ?></a>
  <?php endforeach; ?>
</div>