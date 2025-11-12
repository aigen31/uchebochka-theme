<div class="right-market">
  <?php
  $balance = get_user_meta($user_id, 'user_balance', true);
  $referral_balance = get_user_meta($user_id, 'referral_balance', true);
  ?>
  <div class="yell-block">
    <h5>Баланс пользователя</h5>
    <div class="balans"><?php echo ($balance !== false && $balance !== null) ? esc_html(floatval($balance)) . ' ₽' : '0 ₽'; ?></div>
    <button id="withdrawToggle" class="btn-purple">Вывести деньги</button>
    <form id="withdrawForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display:none; margin-top:10px;">
      <input type="hidden" name="action" value="process_withdraw">
      <?php wp_nonce_field('balance_withdraw_action', 'balance_withdraw_nonce'); ?>
      <label for="withdrawAmount">Введите сумму для вывода:</label>
      <input type="number" id="withdrawAmount" name="withdraw_amount" min="1" step="0.01" required>
      <label for="withdrawDetails">Реквизиты для вывода:</label>
      <textarea id="withdrawDetails" name="withdraw_details" required></textarea>
      <button type="submit" class="btn btn-edit">Подтвердить вывод</button>
    </form>

    <p>Внимание! По закону все доходы физических лиц подлежат налогообложению.</p>
    <p>
      Для самозанятых:<br>
      Налог на профессиональный доход 6% (оплачивается в приложении «Мой налог»).<br>
      Для физических лиц: Налог на доходы физических лиц 13% + страховые взносы 15% / 30%*.
    </p>
  </div>

  <div class="yell-block">
    <h5>Реферальный баланс</h5>
    <div class="balans"><?php echo ($referral_balance !== false && $referral_balance !== null) ? esc_html(floatval($referral_balance)) . ' ₽' : '0 ₽'; ?></div>
    <button id="referralWithdrawToggle" class="btn-purple">Вывести деньги</button>
    <form id="referralWithdrawForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="display:none; margin-top:10px;">
      <input type="hidden" name="action" value="process_referral_withdraw">
      <?php wp_nonce_field('referral_withdraw_action', 'referral_withdraw_nonce'); ?>
      <label for="withdrawAmountReferral">Введите сумму для вывода:</label>
      <input type="number" id="withdrawAmountReferral" name="withdraw_amount" min="1" step="0.01" required>
      <label for="withdrawDetailsReferral">Реквизиты для вывода:</label>
      <textarea id="withdrawDetailsReferral" name="withdraw_details" required></textarea>
      <button type="submit" class="btn btn-edit">Подтвердить вывод</button>
    </form>
  </div>

  <div class="yell-block">
    <h5>История начислений</h5>
    <div id="accrual-history-table-placeholder"></div>
    <div id="accrual-history-pagination" class="accrual-history-pagination"></div>
  </div>

  <div class="yell-block">
    <h5>История платежей</h5>
    <div id="payment-history-table-placeholder"></div>
    <div id="payment-history-pagination" class="payment-history-pagination"></div>
  </div>

  <?php
  // Profile rating block (uses helper functions if present)
  if (function_exists('get_profile_fields') && function_exists('rating_precent')) :
    $profile_fields = get_profile_fields($user_id);
    $rating_percent = rating_precent($profile_fields);
    $rating_class = rating_class($rating_percent);
    $rating_img = get_template_directory_uri() . '/img/profile-rating-' . $rating_class . '.svg';
  ?>
    <div class="rating-profile">
      <div class="subtitle">Рейтинг профиля</div>
      <p>Заполненность вашего профиля повышает доверие покупателя</p>
      <img src="<?php echo esc_url($rating_img); ?>" alt="">
      <div class="profile-rating__progress-comment profile-rating__progress-comment--<?php echo esc_attr($rating_class); ?>">
        <p class="profile-rating__progress-text">
          <?php echo get_profile_rating_comment($rating_class); ?>
        </p>
        <div class="profile-rating__progress-precent">
          <?php echo intval(get_rating_round_precent($rating_percent)); ?>%
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="rating-profile">
      <div class="subtitle">Рейтинг профиля</div>
      <p>Заполненность вашего профиля повышает доверие покупателя</p>
      <img src="<?php echo esc_url(get_template_directory_uri() . '/img/profile-rating-low.svg'); ?>" alt="">
      <div class="profile-rating__progress-comment profile-rating__progress-comment--low">
        <p class="profile-rating__progress-text"><span class="profile-rating__progress-highlight profile-rating__progress-highlight--low">Эх...</span> Будет мало продаж (</p>
        <div class="profile-rating__progress-precent">10%</div>
      </div>
    </div>
  <?php endif; ?>

  <script>
    (function() {
      var toggle = document.getElementById('withdrawToggle');
      var form = document.getElementById('withdrawForm');
      var rtoggle = document.getElementById('referralWithdrawToggle');
      var rform = document.getElementById('referralWithdrawForm');
      if (toggle && form) {
        toggle.addEventListener('click', function() {
          form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
      }
      if (rtoggle && rform) {
        rtoggle.addEventListener('click', function() {
          rform.style.display = rform.style.display === 'none' ? 'block' : 'none';
        });
      }
    })();
  </script>
</div>