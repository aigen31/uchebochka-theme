<?php

/**
 * Template for robotics category taxonomy
 * 
 * @package uchebochka
 */

get_header('tailwind');
echo '</div>';

// Get current term
$term = get_queried_object();
$term_slug = $term ? $term->slug : 'robototehnika';

// Query materials in this category
$args = [
  'post_type' => 'metodic_post',
  'posts_per_page' => 50,
  'post_status' => 'publish',
  'tax_query' => [
    [
      'taxonomy' => 'metodic_category',
      'field' => 'slug',
      'terms' => $term_slug,
    ],
  ],
];

$materials_query = new WP_Query($args);
$total_materials = $materials_query->found_posts;

// PDA Services for demo links
$pda_services = class_exists('PDA_Services') ? new PDA_Services() : null;

// Subscription status
$has_subscription = false;
if (function_exists('uchebka_plugin')) {
  $subscription = uchebka_plugin()->subscription();
  $has_subscription = $subscription->is_active();
}
?>

<!-- Tailwind CDN and custom styles -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/fonts.css">

<style>
  .robototehnika-catalog {
    font-family: "Wix Madefor Display", sans-serif;
  }

  .filter-btn {
    height: 40px;
    padding: 0 20px;
    border-radius: 9999px;
    border: 1px solid #8B5CF6;
    color: #8B5CF6;
    background: transparent;
    font-size: 14px;
    transition: background .15s ease, color .15s ease;
  }

  .filter-btn:hover {
    background: transparent;
  }

  .filter-btn.active {
    background: #7C3AED;
    color: #fff;
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

<div class="robototehnika-catalog bg-[#FBF6EB] text-[#1F2937]">

  <main class="max-w-[1400px] mx-auto px-4 lg:px-8">

    <!-- == Первый экран   -->
    <section class="pt-12 pb-12">
      <div class="max-w-[920px] mx-auto text-center">

        <h1 class="text-[26px] sm:text-[32px] font-semibold">
          <?php echo esc_html($term ? $term->name : 'Выберите учебный материал по робототехнике'); ?>
        </h1>

        <p class="mt-3 text-[#6B7280]">
          <?php echo $term && $term->description ? esc_html($term->description) : 'Подберите материал по возрасту и задаче — всё готово к использованию'; ?>
        </p>

        <div class="mt-10 text-left max-w-[640px] mx-auto">

          <!-- фильтры -->
          <div class="mb-6">
            <div class="text-sm text-[#6B7280] mb-3">Для кого вы подбираете материал?</div>
            <div class="flex gap-3 flex-wrap">
              <button class="filter-btn" data-filter="for" data-value="parent">Родителю</button>
              <button class="filter-btn" data-filter="for" data-value="teacher">Учителю</button>
              <button class="filter-btn" data-filter="for" data-value="group">Кружку / группе</button>
            </div>
          </div>

          <div class="mb-6">
            <div class="text-sm text-[#6B7280] mb-3">Возраст ребёнка</div>
            <div class="flex gap-3 flex-wrap">
              <button class="filter-btn" data-filter="age" data-value="7-9">7–9 лет</button>
              <button class="filter-btn" data-filter="age" data-value="10-12">10–12 лет</button>
              <button class="filter-btn" data-filter="age" data-value="12-16">12–16 лет</button>
            </div>
          </div>

          <p class="text-center text-sm text-[#6B7280] mb-6">
            В каталоге <span id="visible-count"><?php echo intval($total_materials); ?></span> из <?php echo intval($total_materials); ?> готовых материалов. Можно скачать демо перед покупкой.
          </p>

          <!-- ИИшка  -->
          <div
            id="aiBox"
            class="bg-white border-2 border-[#8B5CF6] rounded-[16px] px-5 py-4 flex items-start gap-4 cursor-pointer">

            <!-- иконка  -->
            <div class="w-12 h-12 rounded-full bg-[#F3E8FF] flex items-center justify-center shrink-0">
              ✨
            </div>

            <!-- CONTENT -->
            <div class="flex-1">

              <!-- WELCOME -->
              <div id="aiWelcome">
                <div class="font-semibold">Подобрать материал с помощью AI</div>
                <div class="text-sm text-[#6B7280]">
                  Ответьте на пару вопросов — это займёт меньше минуты
                </div>
              </div>

              <!-- CHAT INTERFACE -->
              <div id="aiChatBlock" class="hidden">

                <!-- Messages -->
                <div id="aiChatMessages" class="space-y-3 mb-3 max-h-[200px] overflow-y-auto text-sm"></div>

                <!-- INPUT -->
                <div id="aiInputBlock">

                  <textarea
                    id="aiTextarea"
                    placeholder="Опишите задачу, возраст, формат занятий…"
                    rows="3"
                    class="w-full resize-none outline-none text-sm leading-relaxed max-h-[340px] overflow-y-auto border border-[#E5E7EB] rounded-lg p-3 resize-y"></textarea>

                  <div class="flex items-center justify-between mt-2">
                    <!-- прикрепление файла -->
                    <div class="text-xs text-[#6B7280]">
                      <label class="cursor-pointer hover:text-[#7C3AED]">
                        📎 Прикрепить файл
                        <input
                          id="aiFileInput"
                          type="file"
                          class="hidden"
                          accept=".png,.jpg,.jpeg,.pdf,.docx">
                      </label>
                    </div>

                    <button
                      type="button"
                      id="aiSendBtn"
                      class="w-10 h-10 rounded-full bg-[#7C3AED] text-white flex items-center justify-center transition hover:bg-[#6D28D9]"
                      title="Отправить">
                      ➤
                    </button>
                  </div>

                  <!-- показать что прикрепил -->
                  <div
                    id="aiFilePreview"
                    class="hidden mt-2 bg-[#F3F4F6] rounded-lg px-3 py-2 text-xs text-[#374151] flex items-center justify-between gap-3">
                    <span id="aiFileName" class="truncate"></span>
                    <button
                      type="button"
                      id="aiRemoveFile"
                      class="text-[#8B5CF6] hover:underline shrink-0">
                      Удалить
                    </button>
                  </div>

                </div>
              </div>
            </div>

            <!-- иконка звезды -->
            <div class="text-yellow-500 text-xl shrink-0">⭐</div>
          </div>

          <!-- Remaining messages info -->
          <div id="aiRemainingInfo" class="mt-2 text-xs text-center text-[#6B7280] hidden"></div>

        </div>
      </div>
    </section>

  </main>

  <!-- ====каталог -->
  <section class="bg-white">
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-12 lg:py-16">
      <div id="catalogGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <?php if ($materials_query->have_posts()) : ?>
          <?php while ($materials_query->have_posts()) : $materials_query->the_post();
            $post_id = get_the_ID();
            $price = (float) get_post_meta($post_id, 'price', true);
            $age_min = (int) get_post_meta($post_id, 'ai_age_min', true);
            $age_max = (int) get_post_meta($post_id, 'ai_age_max', true);
            $for_whom = get_post_meta($post_id, 'ai_for_whom', true);
            $snippet = get_post_meta($post_id, 'ai_card_snippet', true);
            $whats_inside = get_post_meta($post_id, 'ai_whats_inside', true);
            $demo_id = (int) get_post_meta($post_id, 'metodic_demo', true);

            // Determine age range for filter
            $age_range = '';
            if ($age_min >= 7 && $age_max <= 9) $age_range = '7-9';
            elseif ($age_min >= 10 && $age_max <= 12) $age_range = '10-12';
            elseif ($age_min >= 12) $age_range = '12-16';
            elseif ($age_min <= 9 && $age_max >= 7) $age_range = '7-9';
            elseif ($age_min <= 12 && $age_max >= 10) $age_range = '10-12';
            else $age_range = '7-9'; // default

            // Determine "for whom" for filter
            $for_filter = 'parent'; // default
            $for_whom_lower = mb_strtolower($for_whom);
            if (strpos($for_whom_lower, 'учител') !== false) $for_filter = 'teacher';
            elseif (strpos($for_whom_lower, 'кружк') !== false || strpos($for_whom_lower, 'групп') !== false) $for_filter = 'group';
            elseif (strpos($for_whom_lower, 'родител') !== false) $for_filter = 'parent';

            // Demo link
            $demo_link = '';
            if ($demo_id && $pda_services) {
              $demo_link = $pda_services->generate_custom_private_link($demo_id, null, null);
            }

            // Tags for display
            $age_display = $age_min && $age_max ? "{$age_min}–{$age_max} лет" : '';
            $format_tags = [];
            if (strpos($whats_inside, 'PDF') !== false || strpos($whats_inside, 'pdf') !== false) $format_tags[] = 'PDF';
            if (strpos($whats_inside, 'видео') !== false) $format_tags[] = 'видео';
            if (strpos($whats_inside, 'презентац') !== false) $format_tags[] = 'презентации';
          ?>

            <article
              class="card bg-white rounded-[20px] overflow-hidden border border-black/10 flex flex-col h-full"
              data-id="<?php echo intval($post_id); ?>"
              data-for="<?php echo esc_attr($for_filter); ?>"
              data-age="<?php echo esc_attr($age_range); ?>">

              <!-- IMAGE -->
              <?php if (has_post_thumbnail()) : ?>
                <img
                  src="<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'medium')); ?>"
                  alt="<?php echo esc_attr(get_the_title()); ?>"
                  class="w-full h-[190px] object-cover">
              <?php else : ?>
                <div class="w-full h-[190px] bg-[#F3F4F6] flex items-center justify-center text-[#6B7280]">
                  Нет изображения
                </div>
              <?php endif; ?>

              <!-- CONTENT -->
              <div class="p-5 flex flex-col h-full">

                <h3 class="font-semibold text-[16px] leading-snug mb-3">
                  <?php the_title(); ?>
                </h3>

                <!-- TAGS -->
                <div class="flex flex-wrap gap-2 mb-3">
                  <?php if ($age_display) : ?>
                    <span class="px-3 py-1 rounded-full bg-[#F3F4F6] text-xs"><?php echo esc_html($age_display); ?></span>
                  <?php endif; ?>
                  <?php if (!empty($format_tags)) : ?>
                    <span class="px-3 py-1 rounded-full bg-[#F3F4F6] text-xs"><?php echo esc_html(implode(' + ', $format_tags)); ?></span>
                  <?php endif; ?>
                </div>

                <?php if ($for_whom) : ?>
                  <div class="flex flex-wrap gap-2 mb-3">
                    <span class="px-3 py-1 rounded-full bg-[#F3E8FF] text-[#7C3AED] text-xs">
                      <?php echo esc_html(ucfirst($for_whom)); ?>
                    </span>
                  </div>
                <?php endif; ?>

                <?php if ($snippet) : ?>
                  <p class="text-sm text-[#6B7280] mb-3">
                    <?php echo esc_html($snippet); ?>
                  </p>
                <?php endif; ?>

                <p class="text-sm text-[#7C3AED] mb-4">
                  Материал вызывает интерес
                </p>

                <div class="text-[22px] font-medium text-[#7C3AED] mb-5">
                  <?php echo $price > 0 ? number_format($price, 0, '', ' ') . ' ₽' : 'Бесплатно'; ?>
                </div>

                <!-- BUTTONS -->
                <div class="mt-auto flex gap-3">

                  <!-- DEMO -->
                  <?php if ($demo_link) : ?>
                    <a
                      href="<?php echo esc_url($demo_link); ?>"
                      target="_blank"
                      class="flex-1 h-11 rounded-full border border-black/15 bg-white text-[#1F2937] text-sm font-medium inline-flex items-center justify-center gap-2 transition hover:bg-[#7C3AED] hover:text-white hover:border-[#7C3AED]">
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M12 3v12m0 0l4-4m-4 4l-4-4M5 21h14" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                      Демо
                    </a>
                  <?php endif; ?>

                  <!-- DETAILS -->
                  <a
                    href="<?php echo esc_url(get_permalink()); ?>"
                    class="<?php echo $demo_link ? 'flex-1' : 'w-full'; ?> h-11 rounded-full bg-[#7C3AED] text-white text-sm font-medium inline-flex items-center justify-center transition hover:bg-white hover:text-[#7C3AED] hover:border hover:border-[#7C3AED]">
                    Подробнее
                  </a>

                </div>

              </div>
            </article>

          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <div class="col-span-full text-center text-[#6B7280] py-10">
            Материалы не найдены
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>


  <!--  ПРОМО  -->
  <section class="bg-[#FBF6EB]">
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-16">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">

        <!-- ITEM 1 -->
        <div>
          <div class="flex justify-center mb-4 text-[#FACC15]">
            ⭐
          </div>
          <h3 class="font-semibold text-lg mb-2">
            Материалы вызывают высокий интерес
          </h3>
          <p class="text-sm text-[#6B7280]">
            Педагоги и родители отмечают вовлечённость учеников
          </p>
        </div>

        <!-- ITEM 2 -->
        <div>
          <div class="flex justify-center mb-4 text-[#7C3AED]">
            📘
          </div>
          <h3 class="font-semibold text-lg mb-2">
            Часто просматривают до конца
          </h3>
          <p class="text-sm text-[#6B7280]">
            Материалы удерживают внимание на протяжении всего занятия
          </p>
        </div>

        <!-- ITEM 3 -->
        <div>
          <div class="flex justify-center mb-4 text-[#7C3AED]">
            🎖
          </div>
          <h3 class="font-semibold text-lg mb-2">
            Готовы к использованию
          </h3>
          <p class="text-sm text-[#6B7280]">
            Все материалы можно начать использовать сразу после скачивания
          </p>
        </div>

      </div>
    </div>
  </section>


  <!--  Подписка CTA  -->
  <section class="bg-white">
    <div class="max-w-[1400px] mx-auto px-4 lg:px-8 py-20">

      <div class="bg-[#7C3AED] rounded-[32px] px-6 py-14 text-center text-white">

        <h2 class="text-2xl sm:text-3xl font-semibold mb-4">
          Выберите материал или оформите подписку
        </h2>

        <p class="text-white/80 max-w-[720px] mx-auto mb-8">
          С подпиской вы получите доступ ко всем материалам по робототехнике
          и другим направлениям
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">

          <a
            href="#catalogGrid"
            class="h-12 px-8 rounded-full bg-white text-[#7C3AED] font-medium inline-flex items-center justify-center border border-transparent transition hover:bg-transparent hover:text-white hover:border-white">
            Выбрать материал
          </a>

          <!-- инфа о подписке -->
          <button
            type="button"
            id="openSubscription"
            class="h-12 px-8 rounded-full border border-white text-white font-medium inline-flex items-center justify-center transition hover:bg-white hover:text-[#7C3AED]">
            Узнать о подписке
          </button>

        </div>

      </div>

    </div>
  </section>

  <!-- Подписка ПОПАП-->
  <?php get_template_part('template-parts/subscription-popup'); ?>

</div><!-- /.robototehnika-catalog -->

<!--  SCRIPTS  -->
<script>
  (function() {
    const hasSubscription = <?php echo $has_subscription ? 'true' : 'false'; ?>;

    /*  FILTERS  */
    const filters = {
      for: null,
      age: null
    };
    let aiFilteredIds = null; // Array of post IDs recommended by AI, or null for no AI filter

    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const group = btn.dataset.filter;
        const value = btn.dataset.value;

        if (filters[group] === value) {
          filters[group] = null;
          btn.classList.remove('active');
        } else {
          filters[group] = value;
          document
            .querySelectorAll(`.filter-btn[data-filter="${group}"]`)
            .forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
        }

        // Clear AI filter when manual filters are used
        aiFilteredIds = null;
        hideAiResetBtn();
        filterCards();
      });
    });

    function filterCards() {
      let visibleCount = 0;
      document.querySelectorAll('.card').forEach(card => {
        const matchFor = !filters.for || card.dataset.for === filters.for;
        const matchAge = !filters.age || card.dataset.age === filters.age;
        const matchAi = aiFilteredIds === null || aiFilteredIds.includes(parseInt(card.dataset.id));
        const visible = matchFor && matchAge && matchAi;
        card.style.display = visible ? '' : 'none';
        if (visible) visibleCount++;
      });
      document.getElementById('visible-count').textContent = visibleCount;
    }

    // AI filter reset button
    function showAiResetBtn() {
      let btn = document.getElementById('aiResetFilterBtn');
      if (!btn) {
        btn = document.createElement('button');
        btn.id = 'aiResetFilterBtn';
        btn.type = 'button';
        btn.className = 'mt-3 text-sm text-[#7C3AED] hover:underline';
        btn.textContent = '✕ Сбросить AI-фильтр и показать все материалы';
        btn.addEventListener('click', () => {
          aiFilteredIds = null;
          hideAiResetBtn();
          filterCards();
        });
        aiChatMessages.parentElement.appendChild(btn);
      }
      btn.classList.remove('hidden');
    }

    function hideAiResetBtn() {
      const btn = document.getElementById('aiResetFilterBtn');
      if (btn) btn.classList.add('hidden');
    }

    filterCards();

    /*  POPUP LOGIC (moved up for addSubscriptionButton access)  */
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

    /*  AI CHAT  */
    const aiBox = document.getElementById('aiBox');
    const aiWelcome = document.getElementById('aiWelcome');
    const aiChatBlock = document.getElementById('aiChatBlock');
    const aiChatMessages = document.getElementById('aiChatMessages');
    const aiTextarea = document.getElementById('aiTextarea');
    const aiSendBtn = document.getElementById('aiSendBtn');
    const aiRemainingInfo = document.getElementById('aiRemainingInfo');

    let chatInitialized = false;

    aiBox.addEventListener('click', function(e) {
      if (e.target.closest('#aiChatBlock')) return;

      if (!chatInitialized) {
        aiWelcome.classList.add('hidden');
        aiChatBlock.classList.remove('hidden');
        chatInitialized = true;

        // Add welcome message
        if (hasSubscription) {
          addMessage('Привет! 👋 Я AI-помощник по подбору учебных материалов.\n\n✨ У вас активна подписка!\n\n🎯 Что я могу:\n• Подберу материалы из каталога под любой запрос\n• Отвечу на вопросы о содержании любого материала\n• Проанализирую ваши файлы (программу, учебный план)\n• Сгенерирую персональный учебный материал под вашу задачу\n\nОпишите, какой материал вам нужен, или задайте вопрос!', false);
        } else {
          addMessage('Привет! 👋 Я AI-помощник по подбору учебных материалов.\n\n🎯 Что я могу:\n• Подберу материалы под ваш запрос (возраст, задачи, формат)\n• Отвечу на вопросы о содержании материалов\n• Проанализирую прикреплённые файлы\n• Для подписчиков доступна генерация персональных материалов\n\nРасскажите, для кого вы ищете материал и какие задачи хотите решить? Можно приложить программу занятий или описание задачи.', false);
        }

        // Check remaining messages
        if (!hasSubscription) {
          checkRemainingMessages();
        }
      }
    });

    function addMessage(text, isUser) {
      const wrap = document.createElement('div');
      wrap.className = 'flex gap-2 ' + (isUser ? 'justify-end' : '');
      const safe = (text || '').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\n/g, '<br>');

      wrap.innerHTML = `
      ${!isUser ? '<span class="w-6 h-6 rounded-full bg-[#EDE9FE] text-[#7C3AED] flex items-center justify-center text-xs shrink-0">⭐</span>' : ''}
      <div class="${isUser ? 'bg-[#7C3AED] text-white' : 'bg-[#F3F4F6]'} rounded-lg px-3 py-2 max-w-[85%]">${safe}</div>
    `;

      aiChatMessages.appendChild(wrap);
      aiChatMessages.scrollTop = aiChatMessages.scrollHeight;
    }

    function addPdfDownloadButton(url, title) {
      const wrap = document.createElement('div');
      wrap.className = 'flex gap-2';
      wrap.innerHTML = `
      <span class="w-6 h-6 rounded-full bg-[#EDE9FE] text-[#7C3AED] flex items-center justify-center text-xs shrink-0">📄</span>
      <a href="${url}" target="_blank" download
         class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-[#7C3AED] text-white text-sm hover:bg-[#6D28D9] transition">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 3v12m0 0l4-4m-4 4l-4-4M5 21h14"/>
        </svg>
        <span>${title}</span>
      </a>
    `;
      aiChatMessages.appendChild(wrap);
      aiChatMessages.scrollTop = aiChatMessages.scrollHeight;
    }

    function addSubscriptionButton() {
      const wrap = document.createElement('div');
      wrap.className = 'flex gap-2 mt-2';
      wrap.innerHTML = `
      <span class="w-6 h-6 rounded-full bg-[#EDE9FE] text-[#7C3AED] flex items-center justify-center text-xs shrink-0">✨</span>
      <button type="button"
         class="subscription-cta-btn inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#7C3AED] text-white text-sm font-medium hover:bg-[#6D28D9] transition">
        <span>🎁</span>
        <span>Оформить подписку</span>
      </button>
    `;

      // Add click handler to open popup
      wrap.querySelector('.subscription-cta-btn').addEventListener('click', openSubscriptionPopup);

      aiChatMessages.appendChild(wrap);
      aiChatMessages.scrollTop = aiChatMessages.scrollHeight;
    }

    function checkRemainingMessages() {
      const headers = {};
      if (isLoggedIn) {
        headers['X-WP-Nonce'] = wpNonce;
      }

      fetch('/wp-json/uchebka/v1/ai/remaining_messages', {
          headers: headers,
          credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
          if (!data.unlimited && data.remaining !== undefined) {
            aiRemainingInfo.classList.remove('hidden');
            aiRemainingInfo.textContent = `Осталось ${data.remaining} сообщений. Оформите подписку для неограниченного доступа.`;
          }
        })
        .catch(() => {});
    }

    aiSendBtn.addEventListener('click', sendMessage);
    aiTextarea.addEventListener('keydown', function(e) {
      if (e.ctrlKey && e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
      }
    });

    const isLoggedIn = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;
    const wpNonce = '<?php echo wp_create_nonce('wp_rest'); ?>';

    function sendMessage() {
      const text = aiTextarea.value.trim();
      if (!text) return;

      // Check for attached file
      const attachedFile = fileInput.files[0] || null;
      const displayText = attachedFile ?
        text + '\n📎 ' + attachedFile.name :
        text;

      addMessage(displayText, true);
      aiTextarea.value = '';

      // Clear file after sending
      if (attachedFile) {
        fileInput.value = '';
        fileNameEl.textContent = '';
        filePreview.classList.add('hidden');
      }

      // Show loading
      addMessage('Думаю...', false);

      // Build FormData for file upload support
      const formData = new FormData();
      formData.append('message', text);
      if (attachedFile) {
        formData.append('file', attachedFile);
      }

      const headers = {};
      if (isLoggedIn) {
        headers['X-WP-Nonce'] = wpNonce;
      }

      fetch('/wp-json/uchebka/v1/ai/catalog_assistant', {
          method: 'POST',
          headers: headers,
          credentials: 'same-origin',
          body: formData
        })
        .then(r => r.json())
        .then(data => {
          // Remove loading message
          aiChatMessages.lastChild.remove();

          if (data.code) {
            addMessage('Ошибка: ' + (data.message || 'Попробуйте позже'), false);
            return;
          }

          let reply = data.rationale || '';

          // Check if PDF was generated
          if (data.pdf_url) {
            addMessage(reply, false);
            addPdfDownloadButton(data.pdf_url, data.pdf_title || 'Скачать материал');
          } else if (data.can_generate) {
            // User has subscription, show generation hint
            addMessage(reply, false);
          } else {
            // Handle suggestions if available
            if (data.suggestions && data.suggestions.length > 0) {
              // Extract IDs for filtering
              const ids = data.suggestions.map(s => parseInt(s.id)).filter(id => !isNaN(id) && id > 0);

              if (ids.length > 0) {
                // Apply AI filter to catalog
                aiFilteredIds = ids;

                // Clear manual filters
                filters.for = null;
                filters.age = null;
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));

                filterCards();
                showAiResetBtn();

                // Scroll to catalog
                document.getElementById('catalogGrid').scrollIntoView({
                  behavior: 'smooth',
                  block: 'start'
                });
              }

              reply += '\n\nРекомендую посмотреть:\n';
              data.suggestions.forEach(s => {
                reply += `• ${s.title}` + (s.reason ? ` — ${s.reason}` : '') + '\n';
              });
            }

            addMessage(reply, false);

            // Always show subscription button if AI suggests it
            if (data.show_subscription_cta) {
              addSubscriptionButton();
            }
          }

          // Update remaining
          if (data.remaining_messages !== undefined && data.remaining_messages !== null) {
            aiRemainingInfo.classList.remove('hidden');
            aiRemainingInfo.textContent = `Осталось ${data.remaining_messages} сообщений.`;
          }
        })
        .catch(() => {
          aiChatMessages.lastChild.remove();
          addMessage('Произошла ошибка. Попробуйте позже.', false);
        });
    }

    // File handling
    const fileInput = document.getElementById('aiFileInput');
    const filePreview = document.getElementById('aiFilePreview');
    const fileNameEl = document.getElementById('aiFileName');
    const removeFileBtn = document.getElementById('aiRemoveFile');

    fileInput.addEventListener('change', () => {
      const file = fileInput.files[0];
      if (!file) return;

      const allowedTypes = [
        'image/png',
        'image/jpeg',
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
      ];

      if (!allowedTypes.includes(file.type)) {
        fileInput.value = '';
        return;
      }

      fileNameEl.textContent = file.name;
      filePreview.classList.remove('hidden');
    });

    removeFileBtn.addEventListener('click', () => {
      fileInput.value = '';
      fileNameEl.textContent = '';
      filePreview.classList.add('hidden');
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

<?php get_footer('tailwind'); ?>