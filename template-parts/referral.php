<?php
$user = wp_get_current_user();
$referrer_id = uchebka_plugin()->referral()->get_referrer_id();
$referrer = $referrer_id ? get_user_by('id', $referrer_id) : null;
?>
<div class="referral-page">
  <?php the_title('<h2>', '</h2>'); ?>
  <table class="form-table" role="presentation">
    <tr>
      <th><label><?php echo esc_html__('Ваша реферальная ссылка', 'urok'); ?></label></th>
      <td>
        <input type="text" class="regular-text" readonly value="<?php uchebka_plugin()->referral()->the_referral_link(); ?>" onclick="this.select();">
        <p class="description"><?php echo esc_html__('Поделитесь этой ссылкой, чтобы приглашать новых пользователей.', 'urok'); ?></p>
      </td>
    </tr>
    <tr>
      <th><label><?php echo esc_html__('Вас пригласил', 'urok'); ?></label></th>
      <td>
        <?php if ($referrer): ?>
          <?php echo esc_html(sprintf('%s (ID %d, %s)', $referrer->display_name, $referrer->ID, $referrer->user_email)); ?>
        <?php else: ?>
          <em><?php echo esc_html__('Нет данных', 'urok'); ?></em>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <th>
        Уровень реферала
      </th>
      <td>
        <?php
        $ref_level = get_user_meta($user->ID, 'referral_level', true);
        echo !empty($ref_level) ? esc_html($ref_level) : '<em>' . esc_html__('Нет данных', 'urok') . '</em>';
        ?>
      </td>
    </tr>
    <tr>
      <th>
        Баланс
      </th>
      <td>
        <?php
        $ref_balance = get_user_meta($user->ID, 'referral_balance', true);
        echo !empty($ref_balance) ? esc_html($ref_balance) . ' руб.' : '<em>' . esc_html__('Нет данных', 'urok') . '</em>';
        ?>
      </td>
    </tr>
  </table>
  <?php if (is_current_user_admin()) : ?>
    <h2>Магические кнопки</h2>
    <form method="post" class="referral__admin-form action=" <?php echo admin_url('admin-ajax.php'); ?>">
      <input type="hidden" name="action" value="set_level_for_all_users">
      <?php wp_nonce_field('set_level_for_all_users', 'security'); ?>
      <label for="set_level_for_all_users" class="referral__label">Задать всем пользователям 1 уровень, если мета-поле пустое</label>
      <button type="submit" class="button" id="set_level_for_all_users">Задать 1 уровень</button>
    </form>
  <?php endif;

  $items_per_page = 10;
  $page_number = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
  get_template_part('template-parts/table-page', null, [
    'titles' => ['Имя пользователя'],
    'rows' =>  uchebka_plugin()->referral()->get_list($user->ID, $items_per_page, $page_number)->get_query_result(),
    'total' => uchebka_plugin()->referral()->get_list_count($user->ID)->get_query_result(),
    'items_per_page' => $items_per_page,
    'page_number' => $page_number,
  ]);
  ?>
</div>