<div
  id="subscriptionPopup"
  class="fixed inset-0 z-1000 hidden items-center justify-center bg-black/50 px-4"
  aria-hidden="true">
  <div class="bg-[#7C3AED] rounded-[32px] w-full max-w-[720px] text-white relative p-6 sm:p-10">

    <!-- Закрыть -->
    <button
      id="closeSubscription"
      class="absolute top-6 right-6 text-white/80 hover:text-white text-2xl"
      aria-label="Закрыть"
      type="button">
      ✕
    </button>

    <h3 class="text-xl sm:text-2xl font-semibold mb-6">
      Подписка «Учебочка»
    </h3>

    <div class="bg-[#8B5CF6] rounded-[24px] p-6 sm:p-8 mb-8">
      <div class="text-4xl font-semibold mb-4">
        990 ₽ <span class="text-base font-normal text-white/80">в месяц</span>
      </div>

      <ul class="space-y-4 text-sm">
        <li class="flex gap-3">
          <span class="text-yellow-300" aria-hidden="true">✨</span>
          <div>
            <div class="font-medium">Конструктор материалов на основе ИИ</div>
            <div class="text-white/80">
              Персонализированные материалы под ваши задачи
            </div>
          </div>
        </li>

        <li class="flex gap-3">
          <span class="text-yellow-300" aria-hidden="true">⬇️</span>
          <div>
            <div class="font-medium">Неограниченные запросы ИИ</div>
            <div class="text-white/80">
              Гибкий поиск по базе материалов под ваши нужды
            </div>
          </div>
        </li>


      </ul>
    </div>

    <!-- Форма оплаты -->
    <form id="subscriptionForm" class="space-y-4">
      <?php if (!is_user_logged_in()) : ?>
        <div>
          <label for="subEmail" class="block text-sm mb-1">Email *</label>
          <input
            type="email"
            id="subEmail"
            name="email"
            required
            placeholder="your@email.com"
            class="w-full h-12 px-4 rounded-[12px] bg-white/10 text-white placeholder-white/50 border border-white/20 focus:border-white outline-none">
        </div>
      <?php else : ?>
        <div class="bg-white/10 rounded-[12px] px-4 py-3 text-sm">
          <div class="text-white/70 mb-1">Подписка будет привязана к аккаунту:</div>
          <div class="font-medium"><?php echo esc_html(wp_get_current_user()->user_email); ?></div>
        </div>
      <?php endif; ?>
      <div>
        <label for="subPhone" class="block text-sm mb-1">Телефон *</label>
        <input
          type="text"
          id="subPhone"
          name="phone"
          required
          placeholder="+7 (999) 123-45-67"
          class="w-full h-12 px-4 rounded-[12px] bg-white/10 text-white placeholder-white/50 border border-white/20 focus:border-white outline-none">
      </div>

      <div id="subscriptionError" class="hidden text-red-200 text-sm bg-red-500/20 px-4 py-2 rounded-[12px]"></div>
      <div id="subscriptionSuccess" class="hidden text-green-200 text-sm bg-green-500/20 px-4 py-2 rounded-[12px]"></div>

      <div class="text-center pt-2">
        <button
          type="submit"
          id="subscriptionSubmitBtn"
          class="h-12 px-10 rounded-full
                 bg-white text-[#7C3AED]
                 font-medium inline-flex items-center justify-center gap-2
                 border border-transparent
                 transition
                 hover:bg-transparent hover:text-white hover:border-white
                 disabled:opacity-50 disabled:cursor-not-allowed">
          <span id="subscriptionBtnText">🛒 Купить подписку</span>
          <span id="subscriptionBtnLoading" class="hidden">Загрузка...</span>
        </button>

        <div class="text-xs text-white/70 mt-4">
          Подписку можно отменить в любой момент
        </div>
      </div>
    </form>

  </div>
</div>