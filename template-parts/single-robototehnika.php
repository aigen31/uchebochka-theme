<?php

/**
 * Template for single robotics material page
 * 
 * This template is used when viewing a single metodic_post in robototehnika category.
 * To use: create single-metodic_post-robototehnika.php or use template conditionally.
 * 
 * @package uchebochka
 */

// get_header('tailwind');
echo '</div>';

$post_id = get_the_ID();
$title = get_the_title($post_id);
$content = get_the_content();
$price = (float) get_post_meta($post_id, 'price', true);
$demo_id = (int) get_post_meta($post_id, 'metodic_demo', true);

// AI-generated meta fields
$age_min = (int) get_post_meta($post_id, 'ai_age_min', true);
$age_max = (int) get_post_meta($post_id, 'ai_age_max', true);
$for_whom_short = get_post_meta($post_id, 'ai_for_whom', true);
$for_whom_full = get_post_meta($post_id, 'ai_for_whom_full', true);
$whats_inside = get_post_meta($post_id, 'ai_whats_inside', true);
$how_to_use = get_post_meta($post_id, 'ai_how_to_use', true);
$expected_result = get_post_meta($post_id, 'ai_expected_result', true);
$card_snippet = get_post_meta($post_id, 'ai_card_snippet', true);
$what_you_get = get_post_meta($post_id, 'ai_what_you_get', true);

// Demo link via PDA Services
$demo_link = null;
if ($demo_id && class_exists('PDA_Services')) {
  $pda_service = new PDA_Services();
  $demo_link = $pda_service->generate_custom_private_link($demo_id, null, null);
}

// Get categories
$categories = get_the_terms($post_id, 'metodic_category');

// Subscription status
$has_subscription = false;
$subscription_days_left = 0;
$subscription_end_formatted = null;
if (function_exists('uchebka_plugin')) {
  $subscription = uchebka_plugin()->subscription();
  $has_subscription = $subscription->is_active();
  $subscription_days_left = $subscription->get_days_remaining();
  $subscription_end_formatted = $subscription->get_formatted_end_date();
}

// Check if material is already purchased
$is_purchased = false;
$user_id = get_current_user_id();
if ($user_id > 0 && function_exists('uchebka_plugin')) {
  $purchased_materials = uchebka_plugin()->purchased_queries()->user_materials_query($user_id)->get_query_result();
  $purchased_ids = array_column($purchased_materials, 'post_id');
  $is_purchased = in_array($post_id, $purchased_ids);
}

// Check if material is in cart
$is_in_cart = false;
if (function_exists('uchebka_plugin')) {
  if ($user_id > 0) {
    $cart_items = uchebka_plugin()->cart_queries()->get_products_in_cart($user_id);
    $cart_product_ids = array_column($cart_items, 'product_id');
    $is_in_cart = in_array($post_id, $cart_product_ids);
  } else {
    $guest_cart_ids = uchebka_plugin()->guest_cart()->get_product_ids();
    $is_in_cart = in_array($post_id, $guest_cart_ids);
  }
}

// Gallery: video IDs and images
$rutube_ids = get_post_meta($post_id, 'rutube_id');
$vk_video_ids = get_post_meta($post_id, 'vk_video_id');
$gallery_images = get_post_meta($post_id, 'gallery');
$thumbnail_url = get_the_post_thumbnail_url($post_id, 'large');

// Build media items for gallery
$media_items = [];

// RuTube videos
if ($rutube_ids) {
  foreach ($rutube_ids as $rutube_id) {
    if (!empty($rutube_id)) {
      $rutube_id = str_replace('https://rutube.ru/video/', '', $rutube_id);
      $media_items[] = [
        'type' => 'rutube',
        'id' => $rutube_id,
        'thumb' => "https://rutube.ru/api/video/{$rutube_id}/thumbnail/?redirect=1",
      ];
    }
  }
}

// VK videos
if ($vk_video_ids) {
  foreach ($vk_video_ids as $vk_video_id) {
    if (!empty($vk_video_id)) {
      $vk_id = str_replace('https://vkvideo.ru/video', '', $vk_video_id);
      $vk_parts = explode('_', $vk_id);
      if (count($vk_parts) >= 2) {
        $vk_thumb = function_exists('uchebka_plugin') ? uchebka_plugin()->vk_video()->get_vk_thumbnail($vk_video_id) : '';
        $media_items[] = [
          'type' => 'vk',
          'oid' => $vk_parts[0],
          'id' => $vk_parts[1],
          'thumb' => $vk_thumb,
        ];
      }
    }
  }
}

// Thumbnail
if ($thumbnail_url) {
  $media_items[] = [
    'type' => 'image',
    'src' => $thumbnail_url,
    'thumb' => get_the_post_thumbnail_url($post_id, 'thumbnail'),
  ];
}

// Gallery images
if ($gallery_images) {
  foreach ($gallery_images as $image_id) {
    $media_items[] = [
      'type' => 'image',
      'src' => wp_get_attachment_image_url($image_id, 'large'),
      'thumb' => wp_get_attachment_image_url($image_id, 'thumbnail'),
    ];
  }
}

// Show subscription recommendation for materials > 500 RUB
$show_subscription_recommendation = $price > 500;

// Age display
$age_display = '';
if ($age_min && $age_max) {
  $age_display = "{$age_min}–{$age_max} лет";
} elseif ($age_min) {
  $age_display = "от {$age_min} лет";
} elseif ($age_max) {
  $age_display = "до {$age_max} лет";
}

// "What you get" items
$what_you_get_items = [];
if (is_array($what_you_get)) {
  $what_you_get_items = $what_you_get;
} elseif (is_string($what_you_get) && !empty($what_you_get)) {
  $what_you_get_items = array_filter(array_map('trim', explode("\n", $what_you_get)));
}
?>

<!-- Tailwind CDN and custom styles -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/fonts.css">

<style>
  .robototehnika-single {
    font-family: "Wix Madefor Display", sans-serif;
  }

  .quick-btn {
    height: 32px;
    padding: 0 16px;
    border-radius: 9999px;
    border: 1px solid #7C3AED;
    color: #7C3AED;
    font-size: 12px;
    transition: .2s;
    background: transparent;
  }

  .quick-btn:hover {
    background: #7C3AED;
    color: #fff;
  }
</style>

<div class="robototehnika-single bg-[#FBF6EB] text-[#1F2937]">

  <!-- ================= ОСНОВНОЙ КОНТЕЙНЕР СТРАНИЦЫ ================= -->
  <main class="max-w-[1400px] mx-auto px-4 lg:px-8 py-10">

    <!-- ================= СЕТКА СТРАНИЦЫ ================= -->
    <div class="grid grid-cols-1 lg:grid-cols-[520px_1fr] gap-10">


      <!-- ЛЕВАЯ КОЛОНКА: ФОТО / ВИДЕО (ЛИПКИЙ БЛОК) -->

      <aside class="lg:sticky lg:top-6 self-start">

        <!-- ОСНОВНОЙ МЕДИА-БЛОК -->
        <div
          id="mainMedia"
          class="bg-white rounded-[24px] overflow-hidden mb-4 aspect-video flex items-center justify-center">
          <?php if (!empty($media_items)) :
            $first_item = $media_items[0];
            if ($first_item['type'] === 'image') : ?>
              <img src="<?php echo esc_url($first_item['src']); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover">
            <?php elseif ($first_item['type'] === 'rutube') : ?>
              <iframe width="100%" height="100%" src="https://rutube.ru/play/embed/<?php echo esc_attr($first_item['id']); ?>" frameBorder="0" allow="clipboard-write; autoplay" allowFullScreen></iframe>
            <?php elseif ($first_item['type'] === 'vk') : ?>
              <iframe src="https://vkvideo.ru/video_ext.php?oid=<?php echo esc_attr($first_item['oid']); ?>&id=<?php echo esc_attr($first_item['id']); ?>&hd=2" width="100%" height="100%" allow="autoplay; encrypted-media; fullscreen; picture-in-picture;" frameborder="0" allowfullscreen></iframe>
            <?php endif; ?>
          <?php elseif (has_post_thumbnail()) : ?>
            <?php echo get_the_post_thumbnail($post_id, 'large', ['class' => 'w-full h-full object-cover']); ?>
          <?php else : ?>
            <div class="text-[#6B7280]">Нет изображения</div>
          <?php endif; ?>
        </div>

        <!-- МИНИАТЮРЫ -->
        <?php if (count($media_items) > 1) : ?>
          <div class="grid grid-cols-4 gap-3">
            <?php foreach ($media_items as $index => $item) : ?>
              <button
                class="media-thumb bg-white rounded-[16px] overflow-hidden aspect-video <?php echo $index === 0 ? 'border-2 border-[#7C3AED]' : ''; ?>"
                data-type="<?php echo esc_attr($item['type']); ?>"
                <?php if ($item['type'] === 'image') : ?>
                data-src="<?php echo esc_url($item['src']); ?>"
                <?php elseif ($item['type'] === 'rutube') : ?>
                data-rutube-id="<?php echo esc_attr($item['id']); ?>"
                <?php elseif ($item['type'] === 'vk') : ?>
                data-vk-oid="<?php echo esc_attr($item['oid']); ?>"
                data-vk-id="<?php echo esc_attr($item['id']); ?>"
                <?php endif; ?>>
                <img src="<?php echo esc_url($item['thumb'] ?: $item['src']); ?>" class="w-full h-full object-cover" alt="">
              </button>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </aside>


      <!-- ПРАВАЯ КОЛОНКА: КОНТЕНТ -->

      <section>

        <!-- ТЕГИ -->
        <div class="flex flex-wrap gap-2 mb-4 text-sm">
          <?php if ($categories && !is_wp_error($categories)) : ?>
            <?php foreach ($categories as $category) : ?>
              <span class="px-3 py-1 rounded-full bg-[#EDE9FE] text-[#7C3AED]"><?php echo esc_html($category->name); ?></span>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if ($age_display) : ?>
            <span class="px-3 py-1 rounded-full bg-[#F3F4F6]"><?php echo esc_html($age_display); ?></span>
          <?php endif; ?>
        </div>

        <!-- ЗАГОЛОВОК -->
        <h1 class="text-2xl sm:text-3xl font-semibold mb-2">
          <?php echo esc_html($title); ?>
        </h1>

        <?php if ($card_snippet) : ?>
          <p class="text-[#6B7280] mb-6">
            <?php echo esc_html($card_snippet); ?>
          </p>
        <?php endif; ?>

        <!-- AI-ОПИСАНИЕ -->
        <?php if ($for_whom_full || $for_whom_short || $whats_inside || $how_to_use || $expected_result) : ?>
          <div id="aiDescriptionCard" data-ai="description" class="bg-white rounded-[24px] p-6 mb-6">

            <div class="text-sm text-[#6B7280] mb-4 flex items-center gap-2">
              <span aria-hidden="true">📄</span>
              <span>Описание сформировано автоматически</span>
            </div>

            <div id="aiDescriptionText" class="space-y-4 text-sm leading-relaxed" aria-live="polite">
              <?php if ($for_whom_full) : ?>
                <p><b>Для кого:</b> <?php echo esc_html($for_whom_full); ?></p>
              <?php elseif ($for_whom_short) : ?>
                <p><b>Для кого:</b> <?php echo esc_html($for_whom_short); ?></p>
              <?php endif; ?>
              <?php if ($whats_inside) : ?>
                <p><b>Что внутри:</b> <?php echo esc_html($whats_inside); ?></p>
              <?php endif; ?>
              <?php if ($how_to_use) : ?>
                <p><b>Как использовать:</b> <?php echo esc_html($how_to_use); ?></p>
              <?php endif; ?>
              <?php if ($expected_result) : ?>
                <p><b>Результат:</b> <?php echo esc_html($expected_result); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <!--  ЧТО ОНИ ПОЛУЧАТ  -->
        <?php if (!empty($what_you_get_items)) : ?>
          <div class="bg-white rounded-[24px] p-6 mb-6">
            <h2 class="font-semibold mb-4">Что вы получите</h2>

            <ul class="space-y-3 text-sm">
              <?php foreach ($what_you_get_items as $item) : ?>
                <li class="flex gap-3">
                  <span class="w-5 h-5 rounded-full bg-[#7C3AED] text-white flex items-center justify-center text-xs">✓</span>
                  <?php echo esc_html($item); ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <!--  DEMO  -->
        <div class="bg-[#FFF7ED] border border-[#FED7AA] rounded-[24px] p-6 mb-6">
          <div class="font-semibold mb-1 flex items-center gap-2">
            <span aria-hidden="true">⬇️</span>
            <span>Скачайте демо, чтобы оценить формат</span>
          </div>
          <p class="text-sm text-[#6B7280] mb-4">
            Демо-версия включает примеры материалов
          </p>

          <?php if ($demo_link) : ?>
            <a
              href="<?php echo esc_url($demo_link); ?>"
              target="_blank"
              class="inline-flex items-center gap-2 h-10 px-6 rounded-full
                 border border-[#7C3AED] text-[#7C3AED]
                 transition hover:bg-[#7C3AED] hover:text-white">
              Скачать демо
            </a>
          <?php else : ?>
            <div class="text-sm text-[#6B7280]">Демо-версия недоступна</div>
          <?php endif; ?>
        </div>

        <!--  АКТИВНО ИЗУЧАЮТ (SOCIAL PROOF)  -->
        <div id="aiSocialProof" data-ai="social-proof" class="bg-white rounded-[24px] p-6 mb-6 text-sm flex items-start gap-3">
          <span class="mt-[2px]" aria-hidden="true">👁</span>
          <span aria-live="polite">
            <b id="aiSocialProofTitle">Материал активно изучают</b><br>
            <span id="aiSocialProofText" class="text-[#6B7280]">Загружается…</span>
          </span>
        </div>

        <!--  ЦЕНА И КНОПКИ  -->
        <div class="bg-white rounded-[24px] p-6">

          <div class="text-2xl font-semibold text-[#7C3AED] mb-1">
            <?php echo $price > 0 ? number_format($price, 0, '', ' ') . ' ₽' : 'Бесплатно'; ?>
            <span class="text-sm text-[#6B7280] font-normal">за материал</span>
          </div>

          <div class="flex flex-col gap-3 my-4">

            <!-- Купить материал -->
            <?php if ($is_purchased) : ?>
              <a
                href="<?php echo esc_url(home_url('/my-materials/')); ?>"
                class="h-12 rounded-full bg-[#10B981] text-white
                     flex items-center justify-center gap-2
                     transition hover:bg-[#059669]
                     border border-[#10B981]">
                <span>✓</span>
                <span>Материал куплен — перейти к скачиванию</span>
              </a>
            <?php elseif ($is_in_cart) : ?>
              <a
                href="<?php echo esc_url(home_url('/cart/')); ?>"
                class="h-12 rounded-full bg-[#F59E0B] text-white
                     flex items-center justify-center gap-2
                     transition hover:bg-[#D97706]
                     border border-[#F59E0B]">
                <span>🛒</span>
                <span>В корзине — перейти к оформлению</span>
              </a>
            <?php elseif ($price == 0) : ?>
              <button
                type="button"
                id="addToCartBtn"
                data-product-id="<?php echo intval($post_id); ?>"
                class="h-12 rounded-full bg-[#10B981] text-white
                     flex items-center justify-center gap-2
                     transition hover:bg-[#059669]
                     border border-[#10B981]">
                <span>⬇️</span>
                <span id="addToCartBtnText">Получить бесплатно</span>
              </button>
            <?php else : ?>
              <button
                type="button"
                id="addToCartBtn"
                data-product-id="<?php echo intval($post_id); ?>"
                class="h-12 rounded-full bg-[#7C3AED] text-white
                     flex items-center justify-center gap-2
                     transition hover:bg-white hover:text-[#7C3AED]
                     border border-[#7C3AED]
                     disabled:opacity-50 disabled:cursor-not-allowed">
                <span id="addToCartBtnIcon">🛒</span>
                <span id="addToCartBtnText">Купить материал</span>
              </button>
            <?php endif; ?>

            <!-- Оформить подписку -->
            <?php if ($has_subscription) : ?>
              <div class="h-12 rounded-full border border-[#10B981] bg-[#ECFDF5] text-[#059669] flex items-center justify-center gap-2">
                <span>✓</span>
                <span>Подписка до <?php echo esc_html($subscription_end_formatted); ?></span>
              </div>
            <?php else : ?>
              <button
                id="openSubscription"
                type="button"
                class="h-12 rounded-full border border-[#7C3AED] text-[#7C3AED]
                   transition hover:bg-[#7C3AED] hover:text-white">
                Оформить подписку
              </button>
            <?php endif; ?>

          </div>

          <?php if ($has_subscription) : ?>
            <div class="bg-[#ECFDF5] rounded-[16px] px-4 py-3 text-xs text-[#059669]">
              ✨ У вас активна подписка! Доступ ко всем материалам и генератор AI открыты.
            </div>
          <?php elseif ($show_subscription_recommendation) : ?>
            <div class="bg-[#F3F4F6] rounded-[16px] px-4 py-3 text-xs text-[#6B7280]">
              💡 С подпиской выгоднее: доступ ко всем материалам за 990 ₽ / месяц. Если планируете 1–2 материала — подписка экономит деньги.
            </div>
          <?php else : ?>
            <div class="bg-[#F3F4F6] rounded-[16px] px-4 py-3 text-xs text-[#6B7280]">
              💡 С подпиской выгоднее: доступ ко всем материалам за 990 ₽ / месяц
            </div>
          <?php endif; ?>

        </div>

        <!--  AI-ПОМОЩНИК (ПОЛНОЦЕННЫЙ ЧАТ)  -->
        <div class="bg-[#FFF7ED] border border-[#FED7AA] rounded-[24px] mt-6 overflow-hidden">

          <!-- ШАПКА -->
          <div class="flex items-center gap-2 px-4 py-3 border-b border-[#FED7AA] bg-[#FFF7ED]">
            <span class="w-8 h-8 rounded-full bg-[#EDE9FE] text-[#7C3AED] flex items-center justify-center" aria-hidden="true">
              ✨
            </span>
            <div class="text-sm">
              <b>AI-помощник</b><br>
              <span class="text-[#6B7280] text-xs">Поможет с выбором</span>
            </div>
          </div>

          <!-- СООБЩЕНИЯ -->
          <div
            id="aiChatMessages"
            class="px-4 py-4 space-y-4 text-sm max-h-[300px] overflow-y-auto"></div>

          <!-- ВВОД -->
          <div class="border-t border-[#FED7AA] px-3 py-3 space-y-2">

            <textarea
              id="aiInput"
              rows="2"
              placeholder="Задайте вопрос или опишите задачу…"
              class="w-full resize-none bg-[#F3F4F6] text-sm px-4 py-3 rounded-[16px]
                   outline-none focus:ring-2 focus:ring-[#7C3AED]
                   max-h-[120px] overflow-y-auto"></textarea>

            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <label class="cursor-pointer text-xs text-[#6B7280] hover:text-[#7C3AED] transition">
                  📎 Файл
                  <input
                    id="aiFileInput"
                    type="file"
                    class="hidden"
                    accept=".png,.jpg,.jpeg,.pdf,.docx">
                </label>
                <span id="aiFileName" class="text-xs text-[#7C3AED] truncate max-w-[100px] hidden"></span>
                <button
                  type="button"
                  id="aiRemoveFile"
                  class="text-xs text-[#EF4444] hover:underline hidden">Удалить</button>
              </div>
              <div id="aiRemainingInfo" class="text-xs text-[#6B7280]"></div>
              <button
                type="button"
                id="aiSendBtn"
                class="w-10 h-10 rounded-full bg-[#7C3AED] text-white flex items-center justify-center
                     transition hover:bg-[#6D28D9]"
                aria-label="Отправить сообщение"
                title="Отправить">
                ➤
              </button>
            </div>

          </div>

        </div>
        <!--  /AI-ПОМОЩНИК  -->

      </section>
    </div>

  </main>

</div><!-- /.robototehnika-single -->

<!--  ПОДПИСКА: ПОПАП  -->
<div
  id="subscriptionPopup"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
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
          <span class="text-yellow-300" aria-hidden="true">📘</span>
          <div>
            <div class="font-medium">Доступ ко всем материалам</div>
            <div class="text-white/80">
              Робототехника, программирование, STEM и другие направления
            </div>
          </div>
        </li>

        <li class="flex gap-3">
          <span class="text-yellow-300" aria-hidden="true">✨</span>
          <div>
            <div class="font-medium">Конструктор материалов на основе AI</div>
            <div class="text-white/80">
              Персонализированные материалы под ваши задачи
            </div>
          </div>
        </li>

        <li class="flex gap-3">
          <span class="text-yellow-300" aria-hidden="true">⬇️</span>
          <div>
            <div class="font-medium">Неограниченное скачивание</div>
            <div class="text-white/80">
              Скачивайте любые материалы без ограничений
            </div>
          </div>
        </li>

        <li class="flex gap-3">
          <span class="text-yellow-300" aria-hidden="true">⭐</span>
          <div>
            <div class="font-medium">Новые материалы каждую неделю</div>
            <div class="text-white/80">
              Библиотека постоянно пополняется
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
          type="tel"
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

<!--  ЛОГИКА  -->
<script>
  (function() {
    const postId = <?php echo intval($post_id); ?>;
    const hasSubscription = <?php echo $has_subscription ? 'true' : 'false'; ?>;
    const cartUrl = '<?php echo esc_url(home_url('/cart/')); ?>';

    // Add to cart functionality
    const addToCartBtn = document.getElementById('addToCartBtn');
    if (addToCartBtn) {
      addToCartBtn.addEventListener('click', async function() {
        const productId = this.dataset.productId;
        const btnText = document.getElementById('addToCartBtnText');
        const btnIcon = document.getElementById('addToCartBtnIcon');
        
        // Disable button and show loading
        this.disabled = true;
        const originalText = btnText.textContent;
        btnText.textContent = 'Добавляем...';
        
        try {
          const response = await fetch('/wp-json/uchebka/v1/insert_product_to_cart', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              <?php if (is_user_logged_in()) : ?>
              'X-WP-Nonce': '<?php echo wp_create_nonce('wp_rest'); ?>',
              <?php endif; ?>
            },
            credentials: 'same-origin',
            body: JSON.stringify({ product_id: parseInt(productId) })
          });
          
          const data = await response.json();
          
          if (data.status === 'success' || !data.code) {
            // Success - update button to show "In cart" state
            this.className = 'h-12 rounded-full bg-[#F59E0B] text-white flex items-center justify-center gap-2 transition hover:bg-[#D97706] border border-[#F59E0B]';
            if (btnIcon) btnIcon.textContent = '✓';
            btnText.textContent = 'В корзине — перейти к оформлению';
            
            // Update cart counter in header
            document.querySelectorAll('.cart__count').forEach(el => {
              const currentCount = parseInt(el.textContent) || 0;
              el.textContent = currentCount + 1;
            });
            
            // Make button a link to cart
            this.addEventListener('click', function(e) {
              e.preventDefault();
              window.location.href = cartUrl;
            }, { once: true });
            
            this.disabled = false;
          } else {
            // Error
            btnText.textContent = data.message || 'Ошибка';
            setTimeout(() => {
              btnText.textContent = originalText;
              this.disabled = false;
            }, 2000);
          }
        } catch (err) {
          btnText.textContent = 'Ошибка';
          setTimeout(() => {
            btnText.textContent = originalText;
            this.disabled = false;
          }, 2000);
        }
      });
    }

    // Track viewer and get social proof
    fetch('/wp-json/uchebka/v1/ai/social_proof?post_id=' + postId)
      .then(r => r.json())
      .then(d => {
        if (d.text) {
          document.getElementById('aiSocialProofText').textContent = d.text;
        }
      })
      .catch(() => {});

    // Gallery media switching
    const mainMedia = document.getElementById('mainMedia');
    const thumbs = document.querySelectorAll('.media-thumb');

    thumbs.forEach(btn => {
      btn.addEventListener('click', () => {
        // Highlight active thumb
        thumbs.forEach(b => b.classList.remove('border-2', 'border-[#7C3AED]'));
        btn.classList.add('border-2', 'border-[#7C3AED]');

        const type = btn.dataset.type;
        mainMedia.innerHTML = '';

        if (type === 'image') {
          const img = document.createElement('img');
          img.src = btn.dataset.src;
          img.alt = '';
          img.className = 'w-full h-full object-cover';
          mainMedia.appendChild(img);
        } else if (type === 'rutube') {
          const iframe = document.createElement('iframe');
          iframe.src = 'https://rutube.ru/play/embed/' + btn.dataset.rutubeId;
          iframe.width = '100%';
          iframe.height = '100%';
          iframe.frameBorder = '0';
          iframe.allow = 'clipboard-write; autoplay';
          iframe.allowFullscreen = true;
          mainMedia.appendChild(iframe);
        } else if (type === 'vk') {
          const iframe = document.createElement('iframe');
          iframe.src = 'https://vkvideo.ru/video_ext.php?oid=' + btn.dataset.vkOid + '&id=' + btn.dataset.vkId + '&hd=2';
          iframe.width = '100%';
          iframe.height = '100%';
          iframe.allow = 'autoplay; encrypted-media; fullscreen; picture-in-picture;';
          iframe.frameBorder = '0';
          iframe.allowFullscreen = true;
          mainMedia.appendChild(iframe);
        }
      });
    });

    // AI Chat
    const chat = document.getElementById('aiChatMessages');
    const aiInput = document.getElementById('aiInput');
    const aiFileInput = document.getElementById('aiFileInput');
    const aiFileName = document.getElementById('aiFileName');
    const aiRemoveFile = document.getElementById('aiRemoveFile');

    // File handling
    aiFileInput.addEventListener('change', () => {
      const file = aiFileInput.files[0];
      if (!file) return;

      const allowedTypes = [
        'image/png', 'image/jpeg',
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
      ];

      if (!allowedTypes.includes(file.type)) {
        aiFileInput.value = '';
        return;
      }

      aiFileName.textContent = file.name;
      aiFileName.classList.remove('hidden');
      aiRemoveFile.classList.remove('hidden');
    });

    aiRemoveFile.addEventListener('click', () => {
      aiFileInput.value = '';
      aiFileName.textContent = '';
      aiFileName.classList.add('hidden');
      aiRemoveFile.classList.add('hidden');
    });
    const aiSendBtn = document.getElementById('aiSendBtn');
    const aiRemainingInfo = document.getElementById('aiRemainingInfo');

    function addMessage(text, isUser) {
      const wrap = document.createElement('div');
      wrap.className = 'flex gap-3 ' + (isUser ? 'justify-end' : '');
      const safe = (text || '').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\n/g, '<br>');

      wrap.innerHTML = `
      ${!isUser ? '<span class="w-8 h-8 rounded-full bg-[#EDE9FE] text-[#7C3AED] flex items-center justify-center" aria-hidden="true">⭐</span>' : ''}
      <div class="${isUser ? 'bg-[#7C3AED] text-white' : 'bg-[#FBF6EB]'} rounded-[16px] px-4 py-3 max-w-[80%]">${safe}</div>
    `;

      chat.appendChild(wrap);
      chat.scrollTop = chat.scrollHeight;
    }

    function addPdfDownloadButton(url, title) {
      const wrap = document.createElement('div');
      wrap.className = 'flex gap-3';
      wrap.innerHTML = `
        <span class="w-8 h-8 rounded-full bg-[#EDE9FE] text-[#7C3AED] flex items-center justify-center" aria-hidden="true">📄</span>
        <a href="${url}" target="_blank" download
           class="inline-flex items-center gap-2 px-4 py-3 rounded-[16px] bg-[#7C3AED] text-white hover:bg-[#6D28D9] transition">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 3v12m0 0l4-4m-4 4l-4-4M5 21h14"/>
          </svg>
          <span>${title}</span>
        </a>
      `;
      chat.appendChild(wrap);
      chat.scrollTop = chat.scrollHeight;
    }

    // Welcome message for single material
    if (hasSubscription) {
      addMessage('✨ У вас активна подписка! Я помогу с любыми вопросами по этому материалу. Могу также сгенерировать персональный учебный материал — просто опишите задачу.', false);
    } else {
      addMessage('Я помогу понять, подойдёт ли этот материал именно вам. У меня есть доступ к описанию и содержимому материала. Задавайте любые вопросы!', false);
    }

    // Check remaining messages (only if no subscription)
    if (!hasSubscription) {
      const rmHeaders = {};
      <?php if (is_user_logged_in()) : ?>
        rmHeaders['X-WP-Nonce'] = '<?php echo wp_create_nonce('wp_rest'); ?>';
      <?php endif; ?>

      fetch('/wp-json/uchebka/v1/ai/remaining_messages', {
          headers: rmHeaders,
          credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
          if (!data.unlimited && data.remaining !== undefined) {
            aiRemainingInfo.textContent = 'Осталось ' + data.remaining + ' сообщений';
          }
        })
        .catch(() => {});
    }

    function sendMessage() {
      const text = aiInput.value.trim();
      if (!text) return;

      // Check for attached file
      const attachedFile = aiFileInput.files[0] || null;
      const displayText = attachedFile ?
        text + '\n📎 ' + attachedFile.name :
        text;

      addMessage(displayText, true);
      aiInput.value = '';

      // Clear file after sending
      if (attachedFile) {
        aiFileInput.value = '';
        aiFileName.textContent = '';
        aiFileName.classList.add('hidden');
        aiRemoveFile.classList.add('hidden');
      }

      // Show loading
      addMessage('Думаю...', false);

      // Build FormData for file upload support
      const formData = new FormData();
      formData.append('message', text);
      formData.append('post_id', postId);
      if (attachedFile) {
        formData.append('file', attachedFile);
      }

      const chatHeaders = {};
      <?php if (is_user_logged_in()) : ?>
        chatHeaders['X-WP-Nonce'] = '<?php echo wp_create_nonce('wp_rest'); ?>';
      <?php endif; ?>

      fetch('/wp-json/uchebka/v1/ai/catalog_assistant', {
          method: 'POST',
          headers: chatHeaders,
          credentials: 'same-origin',
          body: formData
        })
        .then(r => r.json())
        .then(data => {
          // Remove loading
          chat.lastChild.remove();

          if (data.code) {
            addMessage('Ошибка: ' + (data.message || 'Попробуйте позже'), false);
            return;
          }

          let reply = data.rationale || '';
          
          // Check if PDF was generated
          if (data.pdf_url) {
            addMessage(reply, false);
            addPdfDownloadButton(data.pdf_url, data.pdf_title || 'Скачать материал');
          } else {
            if (data.suggestions && data.suggestions.length > 0) {
              reply += '\n\nРекомендую посмотреть:\n';
              data.suggestions.forEach(s => {
                reply += '• ' + s.title + (s.reason ? ' — ' + s.reason : '') + '\n';
              });
            }
            addMessage(reply, false);
          }

          // Update remaining
          if (data.remaining_messages !== undefined && data.remaining_messages !== null) {
            aiRemainingInfo.textContent = 'Осталось ' + data.remaining_messages + ' сообщений';
          }
        })
        .catch(() => {
          chat.lastChild.remove();
          addMessage('Произошла ошибка. Попробуйте позже.', false);
        });
    }

    aiSendBtn.addEventListener('click', sendMessage);
    aiInput.addEventListener('keydown', function(e) {
      if (e.ctrlKey && e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
      }
    });

    // Subscription popup
    const openBtn = document.getElementById('openSubscription');
    const closeBtn = document.getElementById('closeSubscription');
    const popup = document.getElementById('subscriptionPopup');

    function openSubscriptionPopup() {
      popup.classList.remove('hidden');
      popup.classList.add('flex');
      popup.setAttribute('aria-hidden', 'false');
    }

    function closeSubscriptionPopup() {
      popup.classList.add('hidden');
      popup.classList.remove('flex');
      popup.setAttribute('aria-hidden', 'true');
    }

    // Only bind if button exists (not shown when subscription is active)
    if (openBtn) {
      openBtn.addEventListener('click', openSubscriptionPopup);
    }
    closeBtn.addEventListener('click', closeSubscriptionPopup);

    popup.addEventListener('click', (e) => {
      if (e.target === popup) closeSubscriptionPopup();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !popup.classList.contains('hidden')) closeSubscriptionPopup();
    });

    // Subscription form handling
    const subscriptionForm = document.getElementById('subscriptionForm');
    const subscriptionError = document.getElementById('subscriptionError');
    const subscriptionSuccess = document.getElementById('subscriptionSuccess');
    const subscriptionSubmitBtn = document.getElementById('subscriptionSubmitBtn');
    const subscriptionBtnText = document.getElementById('subscriptionBtnText');
    const subscriptionBtnLoading = document.getElementById('subscriptionBtnLoading');

    subscriptionForm.addEventListener('submit', async function(e) {
      e.preventDefault();

      // Hide messages
      subscriptionError.classList.add('hidden');
      subscriptionSuccess.classList.add('hidden');

      // Show loading
      subscriptionSubmitBtn.disabled = true;
      subscriptionBtnText.classList.add('hidden');
      subscriptionBtnLoading.classList.remove('hidden');

      const isLoggedIn = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;
      const emailInput = document.getElementById('subEmail');
      const phoneInput = document.getElementById('subPhone');

      const email = emailInput ? emailInput.value.trim() : '';
      const phone = phoneInput ? phoneInput.value.trim() : '';

      // Only validate email for guests
      if (!isLoggedIn && !email) {
        subscriptionError.textContent = 'Укажите email';
        subscriptionError.classList.remove('hidden');
        subscriptionSubmitBtn.disabled = false;
        subscriptionBtnText.classList.remove('hidden');
        subscriptionBtnLoading.classList.add('hidden');
        return;
      }

      // Phone is required for everyone
      if (!phone) {
        subscriptionError.textContent = 'Укажите номер телефона';
        subscriptionError.classList.remove('hidden');
        subscriptionSubmitBtn.disabled = false;
        subscriptionBtnText.classList.remove('hidden');
        subscriptionBtnLoading.classList.add('hidden');
        return;
      }

      try {
        const headers = {
          'Content-Type': 'application/json'
        };
        <?php if (is_user_logged_in()) : ?>
          headers['X-WP-Nonce'] = '<?php echo wp_create_nonce('wp_rest'); ?>';
        <?php endif; ?>

        const response = await fetch('/wp-json/uchebka/v1/ai/create_subscription', {
          method: 'POST',
          headers: headers,
          credentials: 'same-origin',
          body: JSON.stringify({
            email,
            phone
          })
        });

        const data = await response.json();

        if (data.code || data.error) {
          subscriptionError.textContent = data.message || data.error || 'Произошла ошибка';
          subscriptionError.classList.remove('hidden');
          subscriptionSubmitBtn.disabled = false;
          subscriptionBtnText.classList.remove('hidden');
          subscriptionBtnLoading.classList.add('hidden');
          return;
        }

        if (data.payment_url) {
          subscriptionSuccess.textContent = data.message || 'Перенаправляем на страницу оплаты...';
          subscriptionSuccess.classList.remove('hidden');

          // Redirect to payment
          setTimeout(() => {
            window.location.href = data.payment_url;
          }, 1000);
        }
      } catch (err) {
        subscriptionError.textContent = 'Произошла ошибка. Попробуйте позже.';
        subscriptionError.classList.remove('hidden');
        subscriptionSubmitBtn.disabled = false;
        subscriptionBtnText.classList.remove('hidden');
        subscriptionBtnLoading.classList.add('hidden');
      }
    });
  })();
</script>

<?php // get_footer('tailwind'); ?>