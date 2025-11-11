<?php
$user = wp_get_current_user();
$referral = new Uchebka_Plugin_Referral();
$items_per_page = 10;
$page_number = isset($_GET['paged']) ? intval($_GET['paged']) : 1;

?>
<div class="referral-accruals-page">
  <?php
  get_template_part('template-parts/table-page', null, [
    'titles' => ['Реферал', 'Сумма'],
    'rows' => $referral->get_referral_accruals_page($user->ID, $items_per_page, $page_number),
    'total' => $referral->get_referral_accruals_count($user->ID),
    'items_per_page' => $items_per_page,
    'page_number' => $page_number,
  ]);
  ?>
</div>