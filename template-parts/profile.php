<div class="section-materials__materials add-material">
  <?php
  // Prepare user data
  $current_user = wp_get_current_user();
  $user = $current_user;
  $user_id = $user->ID;
  ?>

  <div class="bread">
    <ul>
      <li><a href="<?php echo esc_url(home_url('/')); ?>">Главная</a></li>
      <li><span>Личный кабинет</span></li>
    </ul>
  </div>

  <div class="profile">
    <div class="row">
      <div class="col-lg-4 col-md-5 col-12">
        <div class="ava">
          <?php echo get_avatar($user_id, 347); ?>
        </div>
      </div>
      <div class="col-lg-8 col-md-7 col-12">
        <div class="d-flex justify-content-between">
          <div class="name"><?php echo esc_html($user->display_name); ?>
            <?php if (function_exists('um_user_profile_url')) : ?>
              <a href="<?php echo esc_url(um_user_profile_url($user_id)); ?>?um_action=edit"><img src="<?php echo esc_url(get_template_directory_uri() . '/img/edit.png'); ?>" alt="" width="32"></a>
            <?php else : ?>
              <a href="<?php echo esc_url(get_edit_profile_url($user_id)); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/img/edit.png'); ?>" alt="" width="32"></a>
            <?php endif; ?>
          </div>
          <?php if (is_current_user_admin()) : ?>
            <div class="setting">
              <a href="<?php echo esc_url(get_edit_profile_url($user_id)); ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/img/set.png'); ?>" alt=""></a>
            </div>
          <?php endif; ?>
        </div>

        <div class="info-block">
          <div class="item">
            <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9.25 0.25C9.58152 0.25 9.89946 0.381696 10.1339 0.616116C10.3683 0.850537 10.5 1.16848 10.5 1.5V11.5C10.5 11.8315 10.3683 12.1495 10.1339 12.3839C9.89946 12.6183 9.58152 12.75 9.25 12.75H1.75C1.41848 12.75 1.10054 12.6183 0.866116 12.3839C0.631696 12.1495 0.5 11.8315 0.5 11.5V1.5C0.5 1.16848 0.631696 0.850537 0.866116 0.616116C1.10054 0.381696 1.41848 0.25 1.75 0.25H9.25ZM9.25 1.5H6.125V6.5L4.5625 5.09375L3 6.5V1.5H1.75V11.5H9.25V1.5Z" fill="#BBBBBB"></path>
            </svg>
            <span><?php echo get_user_meta($user_id, 'position', true) ?: 'Должность не указана'; ?></span>
          </div>
          <div class="item">
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.95 8.25H6.05V4.95H4.95V8.25ZM5.5 3.85C5.65583 3.85 5.78655 3.7972 5.89215 3.6916C5.99775 3.586 6.05036 3.45547 6.05 3.3C6.04963 3.14453 5.99683 3.014 5.8916 2.9084C5.78636 2.8028 5.65583 2.75 5.5 2.75C5.34416 2.75 5.21363 2.8028 5.1084 2.9084C5.00316 3.014 4.95036 3.14453 4.95 3.3C4.94963 3.45547 5.00243 3.58618 5.1084 3.69215C5.21436 3.79812 5.3449 3.85073 5.5 3.85ZM5.5 11C4.73916 11 4.02417 10.8555 3.355 10.5666C2.68583 10.2777 2.10375 9.88588 1.60875 9.39125C1.11375 8.89661 0.721967 8.31453 0.4334 7.645C0.144834 6.97546 0.000367363 6.26046 6.96202e-07 5.5C-0.00036597 4.73953 0.144101 4.02453 0.4334 3.355C0.7227 2.68547 1.11448 2.10338 1.60875 1.60875C2.10302 1.11412 2.6851 0.722333 3.355 0.4334C4.0249 0.144467 4.7399 0 5.5 0C6.2601 0 6.9751 0.144467 7.645 0.4334C8.31489 0.722333 8.89698 1.11412 9.39125 1.60875C9.88551 2.10338 10.2775 2.68547 10.5671 3.355C10.8568 4.02453 11.0011 4.73953 11 5.5C10.9989 6.26046 10.8544 6.97546 10.5666 7.645C10.2788 8.31453 9.88698 8.89661 9.39125 9.39125C8.89551 9.88588 8.31343 10.2778 7.645 10.5671C6.97656 10.8564 6.26156 11.0007 5.5 11ZM5.5 9.9C6.72833 9.9 7.76875 9.47375 8.62124 8.62125C9.47374 7.76875 9.89999 6.72833 9.89999 5.5C9.89999 4.27167 9.47374 3.23125 8.62124 2.37875C7.76875 1.52625 6.72833 1.1 5.5 1.1C4.27166 1.1 3.23125 1.52625 2.37875 2.37875C1.52625 3.23125 1.1 4.27167 1.1 5.5C1.1 6.72833 1.52625 7.76875 2.37875 8.62125C3.23125 9.47375 4.27166 9.9 5.5 9.9Z" fill="#BBBBBB"></path>
            </svg>
            <span><?php echo get_user_meta($user_id, 'education', true) ?: 'Образование не указано'; ?></span>
          </div>
          <div class="item">
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.95 8.25H6.05V4.95H4.95V8.25ZM5.5 3.85C5.65583 3.85 5.78655 3.7972 5.89215 3.6916C5.99775 3.586 6.05036 3.45547 6.05 3.3C6.04963 3.14453 5.99683 3.014 5.8916 2.9084C5.78636 2.8028 5.65583 2.75 5.5 2.75C5.34416 2.75 5.21363 2.8028 5.1084 2.9084C5.00316 3.014 4.95036 3.14453 4.95 3.3C4.94963 3.45547 5.00243 3.58618 5.1084 3.69215C5.21436 3.79812 5.3449 3.85073 5.5 3.85ZM5.5 11C4.73916 11 4.02417 10.8555 3.355 10.5666C2.68583 10.2777 2.10375 9.88588 1.60875 9.39125C1.11375 8.89661 0.721967 8.31453 0.4334 7.645C0.144834 6.97546 0.000367363 6.26046 6.96202e-07 5.5C-0.00036597 4.73953 0.144101 4.02453 0.4334 3.355C0.7227 2.68547 1.11448 2.10338 1.60875 1.60875C2.10302 1.11412 2.6851 0.722333 3.355 0.4334C4.0249 0.144467 4.7399 0 5.5 0C6.2601 0 6.9751 0.144467 7.645 0.4334C8.31489 0.722333 8.89698 1.11412 9.39125 1.60875C9.88551 2.10338 10.2775 2.68547 10.5671 3.355C10.8568 4.02453 11.0011 4.73953 11 5.5C10.9989 6.26046 10.8544 6.97546 10.5666 7.645C10.2788 8.31453 9.88698 8.89661 9.39125 9.39125C8.89551 9.88588 8.31343 10.2778 7.645 10.5671C6.97656 10.8564 6.26156 11.0007 5.5 11ZM5.5 9.9C6.72833 9.9 7.76875 9.47375 8.62124 8.62125C9.47374 7.76875 9.89999 6.72833 9.89999 5.5C9.89999 4.27167 9.47374 3.23125 8.62124 2.37875C7.76875 1.52625 6.72833 1.1 5.5 1.1C4.27166 1.1 3.23125 1.52625 2.37875 2.37875C1.52625 3.23125 1.1 4.27167 1.1 5.5C1.1 6.72833 1.52625 7.76875 2.37875 8.62125C3.23125 9.47375 4.27166 9.9 5.5 9.9Z" fill="#BBBBBB"></path>
            </svg>
            <span><?php echo get_user_meta($user_id, 'description', true) ?: 'Информация не указана'; ?></span>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="info-user">
    <div class="item mat">
      <div class="num"><?php echo intval(count_user_posts($user_id, 'metodic_post')); ?></div>
      Материалов добавлено
    </div>
    <div class="item date">
      Продавец на платформе<br>
      с <?php echo date_i18n('j.m.Y', strtotime($user->user_registered)); ?>
    </div>
  </div>

  <div class="materials">
    <h2>Опубликованные материалы</h2>

    <a href="/create-material" class="btn mb-3 btn--accent">Опубликовать материал</a>

    <?php
    // Query user's metodic posts
    $args = array(
      'post_type'      => 'metodic_post',
      'posts_per_page' => -1,
      'author'         => $user_id,
      'post_status'    => array('publish', 'pending', 'draft'),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
        $status = get_post_status();
        $status_text = '';
        if ($status == 'publish') {
          $status_text = 'Опубликован';
        } elseif ($status == 'pending' || $status == 'draft') {
          $status_text = 'На модерации';
        }
    ?>
        <div class="item">
          <div class="row">
            <div class="col-md-3 col-12">
              <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?: (get_template_directory_uri() . '/img/default-thumbnail.jpg')); ?>" alt="" />
            </div>
            <div class="col-md-6 col-12">
              <div class="d-flex flex-column justify-content-between h-100">
                <div class="text">
                  <div class="subtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                  <p><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                </div>
                <div class="status"><?php echo esc_html($status_text); ?></div>
              </div>
            </div>
            <div class="col-md-3 col-12">
              <a href="<?php echo esc_url(get_delete_post_link(get_the_ID())); ?>" class="btn btn-del">Удалить</a>
              <a href="<?php echo esc_url(get_edit_post_link()); ?>" class="btn btn-edit">Редактировать</a>
              <a href="<?php the_permalink(); ?>" class="btn btn-go">Перейти к публикации</a>
            </div>
          </div>
        </div>
      <?php endwhile;
    else : ?>
      <p>Нет публикаций.</p>
    <?php endif;
    wp_reset_postdata(); ?>
  </div>

  <div class="materials">
    <h2>Приобретенные материалы</h2>
    <div class="item">
      <div class="document-list">
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . 'purchased_materials';
        $sql = $wpdb->prepare("SELECT post_id FROM $table_name WHERE user_id = %d", $user_id);
        $purchased_posts = $wpdb->get_col($sql);

        if (!empty($purchased_posts)) {
          foreach ($purchased_posts as $post_id) {
            $post = get_post($post_id);
            if ($post) {
        ?>
              <div class="item">
                <div class="row">
                  <div class="col-md-3 col-12">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($post->ID, 'thumbnail') ?: (get_template_directory_uri() . '/img/default-thumbnail.jpg')); ?>" alt="" />
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="d-flex flex-column h-100">
                      <div class="text">
                        <div class="subtitle"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a></div>
                        <p><?php echo wp_trim_words($post->post_excerpt, 15, '...'); ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-12">
                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="btn btn-open">Открыть карточку</a>
                  </div>
                </div>
              </div>
        <?php
            }
          }
        } else {
          echo '<p>Нет скачанных материалов.</p>';
        }
        ?>
      </div>
    </div>
  </div>

</div>

<!-- END CENTER COLUMN -->

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
      <input type="hidden" name="source" value="withdrawal">
      <?php wp_nonce_field('withdraw_action', 'withdraw_nonce'); ?>
      <label for="withdrawAmount">Введите сумму для вывода:</label>
      <input type="number" id="withdrawAmount" name="withdraw_amount" min="1" step="0.01" required>
      <label for="withdrawDetails">Реквизиты для вывода:</label>
      <textarea id="withdrawDetails" name="withdraw_details" required></textarea>
      <button type="submit" class="btn btn-purple">Подтвердить вывод</button>
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
      <input type="hidden" name="action" value="process_withdraw">
      <input type="hidden" name="source" value="referral_withdrawal">
      <?php wp_nonce_field('withdraw_action', 'withdraw_nonce'); ?>
      <label for="withdrawAmountReferral">Введите сумму для вывода:</label>
      <input type="number" id="withdrawAmountReferral" name="withdraw_amount" min="1" step="0.01" required>
      <label for="withdrawDetailsReferral">Реквизиты для вывода:</label>
      <textarea id="withdrawDetailsReferral" name="withdraw_details" required></textarea>
      <button type="submit" class="btn btn-purple">Подтвердить вывод</button>
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