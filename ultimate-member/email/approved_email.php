<?php
/**
 * Template for the "Account Approved Email".
 * Whether to send the user an email when his account is approved.
 *
 * This template can be overridden by copying it to {your-theme}/ultimate-member/email/approved_email.php
 *
 * @version 2.6.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div style="max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;">

	<div style="color: #444444;font-weight: normal;">
		<div style="text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;">{site_name}</div>

		<div style="clear:both"></div>
	</div>

	<div style="padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;">

		<div style="padding: 30px 0;font-size: 24px;text-align: center;line-height: 40px;">Здравствуйте! Спасибо за регистрацию на платформе {site_name}.</div>

		<div style="padding: 10px 0 30px 0;font-size: 15px;line-height: 24px;">Теперь вы можете:<br>— Приобретать материалы для своих занятий<br>— Размещать свои методические разработки в каталог<br>— Пользоваться реферальной программой</div>

		<div style="padding: 10px 0 50px 0;text-align: center;"><a href="{login_url}" style="background: #555555;color: #fff;padding: 12px 30px;text-decoration: none;border-radius: 3px;letter-spacing: 0.3px;">Войти на сайт</a></div>

		<div style="padding: 0 0 15px 0;">

			<div style="background: #eee;color: #444;padding: 12px 15px; border-radius: 3px;font-weight: bold;font-size: 16px;">Информация об аккаунте</div>

			<div style="padding: 10px 15px 0 15px;color: #333;"><span style="color:#999">Email вашего аккаунта:</span> <span style="font-weight:bold">{email}</span></div>
			<div style="padding: 10px 15px 0 15px;color: #333;"><span style="color:#999">Имя пользователя:</span> <span style="font-weight:bold">{username}</span></div>
			<div style="padding: 10px 15px 0 15px;color: #333;"><span style="color:#999">Установить пароль:</span> <span style="font-weight:bold"><a href="{password_reset_link}" style="color: #3ba1da;text-decoration: none;">{password_reset_link}</a></span></div>

		</div>

		<div style="padding:20px;">Если у вас есть вопросы — обратитесь в чат поддержки на сайте.<br><br>Если у вас возникли вопросы или технические сложности, пожалуйста, свяжитесь с нами по адресу <a href="mailto:{admin_email}" style="color: #3ba1da;text-decoration: none">{admin_email}</a></div>

	</div>

	<div style="color: #999;padding: 20px 30px">

		<div style="">Спасибо!</div>
		<div style="">Команда <a href="{site_url}" style="color: #3ba1da;text-decoration: none;">{site_name}</a></div>

	</div>

</div>
