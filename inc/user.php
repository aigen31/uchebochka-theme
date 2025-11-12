<?php

function display_is_user_logged_in($template_path, $name = null, $args = null)
{
  if (is_user_logged_in()) {
    get_template_part($template_path, $name, $args);
  } else {
?>
    <div class="section-materials__materials add-material">
      <div class="page-message page-message--info">
        <p>Вы должны быть авторизованы, чтобы добавить новый материал.</p>
        <a class="link" href="/login">Войти</a>
      </div>
    </div>
<?php
  }
}

function is_current_user_admin()
{
  return in_array('administrator', wp_get_current_user()->roles);
}
