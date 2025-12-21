<div class="section-materials__authentication <?php echo is_user_logged_in() ? 'lk' : '' ?>">
  <div class="section-materials__authentication-tabs">
    <?php if (!is_user_logged_in()) : ?>
      <div class="section-materials__authentication-tab section-materials__authentication-tab--login">
        Вход
      </div>
      <?php if (!is_page('register')) : ?>
        <a href="/register" class="section-materials__authentication-tab section-materials__authentication-tab--registration">
          Регистрация
        </a>
      <?php else : ?>
        <div class="section-materials__authentication-tab section-materials__authentication-tab--registration">
          Регистрация
        </div>
      <?php endif; ?>
    <?php else : ?>
      <div class="section-materials__authentication-tab section-materials__authentication-tab--login">
        Личный кабинет
      </div>
      <div class="section-materials__authentication-tab section-materials__authentication-tab--registration">
        Баланс: <span><?php echo uchebka_plugin()->user_helper()->get_balance(get_current_user_id()); ?> ₽</span>
      </div>
    <?php endif; ?>
  </div>
  <?php if (!is_user_logged_in()) : ?>
    <form class="section-materials__authentication-form" method="post">
      <input class="section-materials__authentication-input" type="text" id="login"
        placeholder="Логин" name="log">
      <input class="section-materials__authentication-input" type="password" id="password" name="pwd"
        placeholder="Пароль">

      <div class="section-materials__authentication--checkbox">
        <div class="custom-checkbox">
          <input type="checkbox" name="rememberme">
          <span class="checkmark"></span>
        </div>
        <span>
          Запомнить меня
        </span>
      </div>

      <button class="btn section-materials__authentication--login" name="wp-submit" type="submit">
        Войти
      </button>

      <div class="text-center">
        <a href="/password-reset" class="section-materials__authentication--forget">Забыли пароль?</a>
      </div>

      <input type="hidden" value="/" name="redirect_to">
      <?php wp_nonce_field('uchebka_login_nonce', 'uchebka_login_nonce'); ?>
    </form>
  <?php else : ?>
    <div class="lk-tab">
      <div class="avatar">
        <?php echo get_avatar(get_current_user_id(), 64); ?>
        <div class="name"><?php echo wp_get_current_user()->display_name; ?></div>
      </div>
      <div class="lk-menu">
        <ul>
          <li><a href="/lichnyj-kabinet/"><img src="<?php echo get_template_directory_uri(); ?>/img/uch.svg" alt=""> Учетная запись</a></li>
          <li><a href="/lichnyj-kabinet/#publish"><img src="<?php echo get_template_directory_uri(); ?>/img/pub.svg" alt=""> Публикации</a></li>
          <li><a href="/lichnyj-kabinet/#materials"><img src="<?php echo get_template_directory_uri(); ?>/img/mat.svg" alt=""> Материалы</a></li>
          <li><a href="/tehnicheskaya-podderzhka"><img src="<?php echo get_template_directory_uri(); ?>/img/chat.png" alt=""> <?php the_unresolved_ticket_message(); ?></a></li>
          <li><a href="/referral"><img src="<?php echo get_template_directory_uri(); ?>/img/referral.svg" alt=""> Реферальная система</a></li>
          <li><a href="/referral-accruals"><img src="<?php echo get_template_directory_uri(); ?>/img/referral-accruals.svg" alt=""> Реферальные начисления</a></li>
          <li class="exit"><a href="/logout"><img src="<?php echo get_template_directory_uri(); ?>/img/exit.svg" alt=""> Выйти</a></li>
        </ul>
      </div>
    </div>
  <?php endif; ?>
</div>