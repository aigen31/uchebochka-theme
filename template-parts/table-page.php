<?php
$total_pages = ceil($args['total'] / $args['items_per_page']);
?>
<div class="table-page">
<table class="table-page__table wp-list-table widefat fixed striped">
  <thead>
    <tr>
      <?php foreach ($args['titles'] as $title): ?>
        <th scope="col" class="manage-column"><?php echo $title; ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($args['rows'])) :
      foreach ($args['rows'] as $row => $column): ?>
        <tr>
          <?php foreach ($column as $column_value): ?>
            <td><?php echo !empty($column_value) ? $column_value : 'Данных нет'; ?></td>
          <?php endforeach; ?>
        </tr>
      <?php
      endforeach;
    else :
      ?>
      <tr>
        <td colspan="<?php echo count($args['titles']); ?>">Нет данных.</td>
      </tr>
    <?php
    endif;
    ?>
  </tbody>
</table>
<?php if ($total_pages > 1): ?>
  <div class="table-page__pagination tablenav-pages" style="margin-top: 20px;">
    <?php
    $base_url = remove_query_arg('paged', $_SERVER['REQUEST_URI']);
    $base_url = admin_url('admin.php') . '?' . http_build_query($_GET);
    for ($i = 1; $i <= $total_pages; $i++):
      $active = ($i === $args['page_number']) ? 'is-active' : '';
      $url = esc_url(add_query_arg('paged', $i, $base_url));
    ?>
      <a href="<?php echo $url; ?>" class="table-page__page-link <?php echo $active; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
  </div>
<?php endif; ?>
</div>