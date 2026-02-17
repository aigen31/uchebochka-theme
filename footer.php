<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uchebochka
 */

?>

<footer>
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-lg-4 col-md-4 col-12">
				<div class="logo">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo2.svg" alt="">
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-12">
				<?php wp_nav_menu([
					'theme_location' => 'footer',
					'container' => 'nav',
					'container_class' => 'footer-menu',
				]);
				?>
			</div>
		</div>
		<div class="row justify-content-between">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="copy">
					<p>Ответственность за разрешение любых спорных моментов, касающихся самих материалов и их содержания, берут на себя пользователи, разместившие материал на сайте. Однако администрация сайта готова оказать всяческую поддержку в решении любых вопросов, связанных с работой и содержанием сайта. Если Вы заметили, что на данном сайте незаконно используются материалы, сообщите об этом администрации сайта через форму обратной связи.</p>

					<p>Все материалы, размещенные на сайте, созданы авторами сайта либо размещены пользователями сайта и представлены на сайте исключительно для ознакомления. Авторские права на материалы принадлежат их законным авторам. Частичное или полное копирование материалов сайта без письменного разрешения администрации сайта запрещено! Мнение администрации может не совпадать с точкой зрения авторов.</p>
				</div>
			</div>
			<div class="offset-lg-1 col-lg-5 col-md-6 col-12">
				<div class="d-flex">
					<div class="menu col-md-6 col-12">
						<nav>
							<ul>
								<li><a href="https://disk.yandex.ru/d/USXPR9DYgVPESQ">Сведения об организации</a></li>
								<li><a href="https://disk.yandex.ru/d/C5bvbYeQVAn2KA">Пользовательское соглашение</a></li>
								<li><a href="https://disk.yandex.ru/i/ZNwuGX5lO0I6QA">Политика конфиденциальности</a></li>
								<li><a href="https://disk.yandex.ru/d/i3sVtjs492XWXQ">Политика персональных данных</a></li>
								<li><a href="https://test.xn--80ablvt1a2ad.xn--p1ai/wp-content/uploads/2026/01/offer.docx">Оферта</a></li>
							</ul>
						</nav>

						<div class="copyright">
							&copy; Все права защищены, 2025 г.
						</div>
					</div>
					<div class="marketing col-md-6 col-12">
						<p>По вопросам рекламы:</p>
						<p><a href="mailto:">info@учебочка.рф</a></p>
						<div class="soc">
							<a href="https://vk.me/public219902120" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/socials/vk.svg" alt=""></a>
							<a href="https://t.me/uchebochka_support" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/socials/tg.svg" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				<img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="">
			</button>
			<div class="modal-body">
				<form>
					<div class="mb-3">
						<label for="name" class="form-label">Ваше имя</label>
						<input type="text" class="form-control" id="name" required>
					</div>
					<div class="mb-3">
						<label for="phone" class="form-label">Телефон</label>
						<input type="tel" class="form-control" id="phone" required>
					</div>
					<div class="mb-3">
						<label for="message" class="form-label">Ваш запрос или предложение</label>
						<textarea class="form-control" id="message" rows="3"></textarea>
					</div>
					<p>Мы открыты к обсуждению
						разных форматов сотрудничества!
						Оставьте заявку и мы свяжемся
						с вами в ближайшее время.</p>
					<button type="submit" class="btn btn-submit">Отправить</button>
				</form>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="warning" tabindex="-1" aria-labelledby="warningLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				<img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="">
			</button>
			<div class="modal-body">
				Пожалуйста, войдите или зарегистрируйтесь, чтобы совершить оплату.
			</div>
		</div>
	</div>
</div>

<?php get_template_part('template-parts/purchase-modal'); ?>

<script src="<?php echo get_template_directory_uri(); ?>/src/js/bootstrap.bundle.min.js"></script>
<script>
	(function(w, d, u) {
		var s = d.createElement('script');
		s.async = true;
		s.src = u + '?' + (Date.now() / 60000 | 0);
		var h = d.getElementsByTagName('script')[0];
		h.parentNode.insertBefore(s, h);
	})(window, document, 'https://cdn-ru.bitrix24.ru/b34192886/crm/site_button/loader_7_umih4f.js');
</script>
<?php wp_footer(); ?>
</body>

</html>