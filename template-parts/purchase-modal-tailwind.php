<!-- Modal: Instant Purchase (Tailwind CSS) -->
<div
  id="instantPurchaseModal"
  tabindex="-1"
  class="hidden"
  aria-labelledby="instantPurchaseModalLabel"
  aria-hidden="true">
  <div class="fixed flex z-1000 inset-0 items-center justify-center bg-black/50">
    <div class="relative w-full max-w-md mx-4">
      <div class="bg-white rounded-2xl shadow-xl" onclick="event.stopPropagation()">
        <button
          type="button"
          class="btn-close absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors z-10"
          data-dismiss="modal"
          aria-label="Close">
          <img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="">
        </button>
        <div class="p-6">
          <h4 class="text-2xl font-semibold mb-4" id="instantPurchaseModalLabel">Быстрая покупка</h4>

          <div class="mb-4 p-4 bg-purple-50 rounded-xl border border-purple-200">
            <div class="font-medium text-gray-900 mb-1" id="instantPurchaseProductTitle"></div>
            <div class="text-lg font-semibold text-purple-600" id="instantPurchaseProductPrice"></div>
          </div>

          <form id="instantPurchaseForm">
            <input type="hidden" name="action" value="instant_checkout">
            <input type="hidden" name="product_id" id="instantPurchaseProductId" value="">

            <?php if (!is_user_logged_in()) : ?>
              <div class="mb-4">
                <label for="instantPurchaseEmail" class="block text-sm font-medium text-gray-700 mb-1">
                  Email <span class="text-red-500">*</span>
                </label>
                <input
                  type="email"
                  class="w-full h-12 px-4 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition-colors"
                  id="instantPurchaseEmail"
                  name="email"
                  required
                  placeholder="Введите ваш email">
              </div>
              <div class="mb-4">
                <label for="instantPurchasePhone" class="block text-sm font-medium text-gray-700 mb-1">
                  Телефон <span class="text-red-500">*</span>
                </label>
                <input
                  type="tel"
                  class="w-full h-12 px-4 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 outline-none transition-colors"
                  id="instantPurchasePhone"
                  name="phone"
                  required
                  placeholder="+7 (___) ___-__-__">
              </div>
              <p class="text-sm text-gray-600 mb-4">
                После оплаты на указанный email будет отправлен пароль для входа в личный кабинет и ссылки на купленные материалы.
              </p>
            <?php else :
              $current_user = wp_get_current_user();
            ?>
              <div class="mb-4 p-4 bg-gray-50 rounded-xl">
                <p class="mb-1">
                  <strong class="text-gray-900">Покупатель:</strong>
                  <span class="text-gray-700"><?php echo esc_html($current_user->display_name); ?></span>
                </p>
                <p class="mb-0 text-sm text-gray-600"><?php echo esc_html($current_user->user_email); ?></p>
              </div>
            <?php endif; ?>

            <button
              type="submit"
              class="w-full h-12 rounded-xl bg-purple-600 text-white font-medium hover:bg-purple-700 transition-colors"
              id="instantPurchaseSubmit">
              Оплатить
            </button>

            <div id="instantPurchaseError" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>