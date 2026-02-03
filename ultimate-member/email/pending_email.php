<?php
/**
 * Template for the "Your account is pending review".
 * Whether to send the user an email when his account needs admin review.
 *
 * This template can be overridden by copying it to {your-theme}/ultimate-member/email/pending_email.php
 *
 * @version 2.6.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>


<div style="max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;">

	<div style="color: #444444;font-weight: normal;">
		<div style="text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;">{site_name}</div>

		<div style="clear:both"></div>
	</div>

	<div style="padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;">

		<div style="padding: 30px 0;font-size: 24px;text-align: center;line-height: 40px;">Здравствуйте! Спасибо за регистрацию на платформе {site_name}.<span style="display: block;">Ваш аккаунт должен быть проверен вручную.</span></div>

		<div style="padding: 15px;background: #eee;border-radius: 3px;text-align: center;">Пожалуйста, дайте нам немного времени, чтобы обработать ваш запрос и проверить вашу информацию.</div>

		<div style="padding:20px;">Если у вас возникли вопросы или технические сложности, пожалуйста, свяжитесь с нами по адресу <a href="mailto:{admin_email}" style="color: #3ba1da;text-decoration: none">{admin_email}</a></div>

	</div>

	<div style="color: #999;padding: 20px 30px">

		<div style="">Спасибо!</div>
		<div style="">Команда <a href="{site_url}" style="color: #3ba1da;text-decoration: none;">{site_name}</a></div>

	</div>

</div>
