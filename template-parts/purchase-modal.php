<!-- Modal: Instant Purchase -->
<div class="modal fade" id="instantPurchaseModal" tabindex="-1" aria-labelledby="instantPurchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="">
      </button>
      <div class="modal-body">
        <h4 class="modal-title mb-3" id="instantPurchaseModalLabel">Быстрая покупка</h4>

        <div class="instant-purchase-product mb-3">
          <div class="instant-purchase-product__title" id="instantPurchaseProductTitle"></div>
          <div class="instant-purchase-product__price" id="instantPurchaseProductPrice"></div>
        </div>

        <form id="instantPurchaseForm">
          <input type="hidden" name="action" value="instant_checkout">
          <input type="hidden" name="product_id" id="instantPurchaseProductId" value="">

          <?php if (!is_user_logged_in()) : ?>
            <div class="mb-3">
              <label for="instantPurchaseEmail" class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="instantPurchaseEmail" name="email" required placeholder="Введите ваш email">
            </div>
            <div class="mb-3">
              <label for="instantPurchasePhone" class="form-label">Телефон <span class="text-danger">*</span></label>
              <input type="tel" class="form-control" id="instantPurchasePhone" name="phone" required placeholder="+7 (___) ___-__-__">
            </div>
            <p class="text-muted small mb-3">
              После оплаты на указанный email будет отправлен пароль для входа в личный кабинет и ссылки на купленные материалы.
            </p>
          <?php else :
            $current_user = wp_get_current_user();
          ?>
            <div class="mb-3">
              <p class="mb-1"><strong>Покупатель:</strong> <?php echo esc_html($current_user->display_name); ?></p>
              <p class="mb-0 text-muted small"><?php echo esc_html($current_user->user_email); ?></p>
            </div>
          <?php endif; ?>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-submit" id="instantPurchaseSubmit">
              Оплатить
            </button>
          </div>

          <div id="instantPurchaseError" class="alert alert-danger mt-3 d-none"></div>
        </form>
      </div>
    </div>
  </div>
</div>