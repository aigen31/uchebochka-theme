<?php
/**
 * Tailwind CSS Footer Template
 *
 * @package uchebochka
 */
?>

<footer>
  <div class="container">
    <div class="flex flex-wrap items-center justify-between">
      <div class="w-full md:w-1/3 lg:w-1/3">
        <div class="logo">
          <img src="<?php echo get_template_directory_uri(); ?>/img/logo2.svg" alt="">
        </div>
      </div>
      <div class="w-full md:w-2/3 lg:w-2/3">
        <?php wp_nav_menu([
          'theme_location' => 'footer',
          'container' => 'nav',
          'container_class' => 'footer-menu',
        ]);
        ?>
      </div>
    </div>
    <div class="flex flex-wrap justify-between">
      <div class="w-full md:w-1/2 lg:w-1/2">
        <div class="copy">
          <p>Ответственность за разрешение любых спорных моментов, касающихся самих материалов и их содержания, берут на себя пользователи, разместившие материал на сайте. Однако администрация сайта готова оказать всяческую поддержку в решении любых вопросов, связанных с работой и содержанием сайта. Если Вы заметили, что на данном сайте незаконно используются материалы, сообщите об этом администрации сайта через форму обратной связи.</p>

          <p>Все материалы, размещенные на сайте, созданы авторами сайта либо размещены пользователями сайта и представлены на сайте исключительно для ознакомления. Авторские права на материалы принадлежат их законным авторам. Частичное или полное копирование материалов сайта без письменного разрешения администрации сайта запрещено! Мнение администрации может не совпадать с точкой зрения авторов.</p>
        </div>
      </div>
      <div class="w-full md:w-1/2 lg:w-5/12 lg:ml-[8.333%]">
        <div class="flex">
          <div class="menu w-full md:w-1/2">
            <nav>
              <ul>
                <li><a href="https://disk.yandex.ru/d/USXPR9DYgVPESQ">Сведения об организации</a></li>
                <li><a href="https://disk.yandex.ru/d/C5bvbYeQVAn2KA">Пользовательское соглашение</a></li>
                <li><a href="https://disk.yandex.ru/i/ZNwuGX5lO0I6QA">Политика конфиденциальности</a></li>
                <li><a href="https://disk.yandex.ru/d/i3sVtjs492XWXQ">Политика персональных данных</a></li>
              </ul>
            </nav>

            <div class="copyright">
              &copy; Все права защищены, 2025 г.
            </div>
          </div>
          <div class="marketing w-full md:w-1/2">
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

<!-- Consult Modal -->
<div
  id="consultModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
  tabindex="-1"
  aria-labelledby="consultModalLabel"
  aria-hidden="true"
>
  <div class="relative w-full max-w-md mx-4">
    <div class="bg-white rounded-2xl shadow-xl">
      <button
        type="button"
        class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors btn-close"
        data-dismiss="modal"
        aria-label="Close"
      >
        <img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="">
      </button>
      <div class="p-6">
        <form>
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ваше имя</label>
            <input type="text" class="w-full h-12 px-4 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition-colors" id="name" required>
          </div>
          <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
            <input type="tel" class="w-full h-12 px-4 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition-colors" id="phone" required>
          </div>
          <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Ваш запрос или предложение</label>
            <textarea class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition-colors resize-none" id="message" rows="3"></textarea>
          </div>
          <p class="text-sm text-gray-600 mb-4">Мы открыты к обсуждению
            разных форматов сотрудничества!
            Оставьте заявку и мы свяжемся
            с вами в ближайшее время.</p>
          <button type="submit" class="w-full h-12 rounded-xl bg-purple-600 text-white font-medium hover:bg-purple-700 transition-colors btn btn-submit">Отправить</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Warning Modal -->
<div
  id="warning"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50"
  tabindex="-1"
  aria-labelledby="warningLabel"
  aria-hidden="true"
>
  <div class="relative w-full max-w-sm mx-4">
    <div class="bg-white rounded-2xl shadow-xl">
      <button
        type="button"
        class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors btn-close"
        data-dismiss="modal"
        aria-label="Close"
      >
        <img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="">
      </button>
      <div class="p-6 text-center">
        Пожалуйста, войдите или зарегистрируйтесь, чтобы совершить оплату.
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  // Modal functionality
  function setupModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;

    const closeBtn = modal.querySelector('.btn-close');

    function openModal() {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      modal.setAttribute('aria-hidden', 'true');
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', closeModal);
    }

    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });

    // Expose open function globally
    window['open' + modalId.charAt(0).toUpperCase() + modalId.slice(1)] = openModal;

    return { open: openModal, close: closeModal };
  }

  setupModal('consultModal');
  setupModal('warning');

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.fixed.flex').forEach(modal => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.setAttribute('aria-hidden', 'true');
      });
    }
  });
})();
</script>

<script>
  (function(w,d,u){
    var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
    var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
  })(window,document,'https://cdn-ru.bitrix24.ru/b34192886/crm/site_button/loader_5_wlrv90.js');
</script>
<?php wp_footer(); ?>
</body>

</html>
