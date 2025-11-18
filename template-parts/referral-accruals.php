<?php
$user = wp_get_current_user();
$items_per_page = 10;
$page_number = isset($_GET['paged']) ? intval($_GET['paged']) : 1;

?>
<div class="referral-accruals-page">
  <?php
  get_template_part('template-parts/table-page', null, [
    'titles' => ['Реферал', 'Сумма'],
    'rows' => uchebka_plugin()->referral()->get_accruals_page($user->ID, $items_per_page, $page_number)->get_query_result(),
    'total' => uchebka_plugin()->referral()->get_accruals_count($user->ID)->get_query_result(),
    'items_per_page' => $items_per_page,
    'page_number' => $page_number,
  ]);
  ?>
</div>