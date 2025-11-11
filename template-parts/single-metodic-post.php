<?php
$metodic_file = get_post_meta($post->ID, 'metodic_file', true);
?>
<section class="section-materials">
  <div class="container d-md-flex">

    <?php get_template_part('template-parts/column', 'left'); ?>

    <!-- CENTER COLUMN -->

    <div class="page-article">
      <div class="bread">
        <?php
        if (function_exists('yoast_breadcrumb')) {
          yoast_breadcrumb();
        } ?>
      </div>

      <h1><?php the_title(); ?></h1>

      <div class="rating-article">
        <?php if (function_exists('the_ratings')) {
          the_ratings();
        } ?>
      </div>

      <div class="gallery">
        <div class="slider-container">
          <div class="main-slider">
            <div class="slider-wrapper">
              <?php
              $slide_index = 0;

              $rutube_ids = get_field('rutube_id');
              if (!empty($rutube_ids)) {
                $rutube_ids = array_map(function ($id) {
                  return str_replace('https://rutube.ru/video/', '', $id);
                }, $rutube_ids);
                foreach ($rutube_ids as $rutube_id) :
              ?>
                  <div class="slide <?php echo $slide_index === 0 ? 'active' : ''; ?>">
                    <iframe width="100%" height="100%" src="<?php echo esc_attr("https://rutube.ru/play/embed/$rutube_id") ?>" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                  </div>
                <?php
                  $slide_index++;
                endforeach;
              }

              $vk_video_ids = get_field('vk_video_id');
              if (!empty($vk_video_ids)) {
                $vk_video_ids = array_map(function ($id) {
                  $id = str_replace('https://vkvideo.ru/video', '', $id);
                  return explode('_', $id);
                }, $vk_video_ids);
                foreach ($vk_video_ids as $vk_video_id) :
                ?>
                  <div class="slide <?php echo $slide_index === 0 ? 'active' : ''; ?>">
                    <iframe src="https://vkvideo.ru/video_ext.php?oid=<?php echo esc_attr($vk_video_id[0]); ?>&id=<?php echo esc_attr($vk_video_id[1]); ?>&hd=2" width="100%" height="100%" style="background-color: #000" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>
                  </div>
                <?php
                  $slide_index++;
                endforeach;
              }

              $thumbnail = get_the_post_thumbnail_url();
              if ($thumbnail) { ?>
                <div class="slide <?php echo $slide_index === 0 ? 'active' : ''; ?>">
                  <img src="<?php echo esc_url($thumbnail) ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
                </div>
                <?php
                $slide_index++;
              }

              $images = get_post_meta($post->ID, 'gallery');
              if ($images) {
                foreach ($images as $image) {
                  $attachment = wp_get_attachment_image_url($image, 'full');
                ?>
                  <div class="slide <?php echo $slide_index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $attachment; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                  </div>
              <?php
                  $slide_index++;
                }
              }
              ?>
            </div>

            <button class="slider-arrow prev-arrow"><img src="<?php echo get_template_directory_uri(); ?>/img/prev-arr.svg" alt=""></button>
            <button class="slider-arrow next-arrow"><img src="<?php echo get_template_directory_uri(); ?>/img/next-arr.svg" alt=""></button>
          </div>

          <div class="thumbnails">
            <?php
            $thumb_index = 0;

            $rutube_ids = get_field('rutube_id');
            if (!empty($rutube_ids)) {
              $rutube_ids = array_map(function ($id) {
                return str_replace('https://rutube.ru/video/', '', $id);
              }, $rutube_ids);
              foreach ($rutube_ids as $rutube_id) :
            ?>
                <div class="thumbnail <?php echo $thumb_index === 0 ? 'active' : ''; ?>" data-index="<?php echo $thumb_index; ?>">
                  <img src="<?php echo esc_attr("https://rutube.ru/api/video/$rutube_id/thumbnail/?redirect=1") ?>" alt="">
                </div>
              <?php
                $thumb_index++;
              endforeach;
            }

            $vk_video_ids = get_field('vk_video_id');
            if (!empty($vk_video_ids)) {
              foreach ($vk_video_ids as $vk_video_id) :
                $vk_thumbnail = function_exists('uchebka_plugin') ? uchebka_plugin()->vk_video()->get_vk_thumbnail($vk_video_id) : '';
              ?>
                <div class="thumbnail <?php echo $thumb_index === 0 ? 'active' : ''; ?>" data-index="<?php echo $thumb_index; ?>">
                  <img src="<?php echo esc_attr($vk_thumbnail) ?>" alt="">
                </div>
              <?php
                $thumb_index++;
              endforeach;
            }

            if ($thumbnail) { ?>
              <div class="thumbnail <?php echo $thumb_index === 0 ? 'active' : ''; ?>" data-index="<?php echo $thumb_index; ?>">
                <img src="<?php echo esc_url($thumbnail) ?>" alt="<?php echo esc_attr(get_the_title()) ?>">
              </div>
              <?php
              $thumb_index++;
            }

            if ($images) {
              foreach ($images as $image) {
                $attachment_thumb = wp_get_attachment_image_url($image, 'thumbnail');
              ?>
                <div class="thumbnail <?php echo $thumb_index === 0 ? 'active' : ''; ?>" data-index="<?php echo $thumb_index; ?>">
                  <img src="<?php echo $attachment_thumb ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                </div>
            <?php
                $thumb_index++;
              }
            }
            ?>
          </div>
        </div>
      </div>


      <div class="block">
        <h2>Описание материала</h2>
        <?php the_content(); ?>
      </div>

      <div class="block">
        <h2>Комментарии</h2>
        <?php
        if (comments_open() || get_comments_number()) {
          comments_template();
        } else {
          echo '<p>Комментарии закрыты.</p>';
        }
        ?>
      </div>

    </div>

    <div class="right-market">
      <div class="material-info">
        <?php
        $categories = get_the_category();
        $tags = get_the_tags();
        if ($categories || $tags) : ?>
          <div class="cats">
            <?php
            if ($categories) {
              foreach ($categories as $category) {
                echo '<div class="item">' . esc_html($category->name) . '</div>';
              }
            }
            if ($tags) {
              foreach ($tags as $tag) {
                echo '<div class="item">' . esc_html($tag->name) . '</div>';
              }
            }
            ?>
          </div>
        <?php endif; ?>

        <div class="download-info">
          <?php
          $download_count = get_post_meta(get_the_ID(), 'download_count', true);
          $view_count = get_post_meta(get_the_ID(), 'view_count', true);
          ?>
          <p><?php echo $download_count ? $download_count : '0'; ?> скачиваний</p>
          <div class="d-flex">
            <div class="date"><?php echo get_the_date('d.m.Y'); ?></div>
            <div class="see">
              <img src="<?php echo get_template_directory_uri(); ?>/img/see2.svg" alt="">
              <?php echo $view_count ? $view_count : '0'; ?>
            </div>
          </div>
        </div>

        <?php
        // Получаем материал через синглтон плагина
        $material = uchebka_plugin()->methodological_material(get_the_ID());

        // Получаем ID текущего пользователя
        $current_user_id = get_current_user_id();

        // Получаем список купленных записей пользователя
        global $wpdb;
        $purchased_posts = $wpdb->get_col(
          $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->prefix}purchased_materials WHERE user_id = %d",
            $current_user_id
          )
        );

        // ID текущей записи
        $post_id = get_the_ID();

        // Функция проверки покупки
        function is_purchased(int $post_id, array $purchased_posts)
        {
          return in_array((string) $post_id, $purchased_posts, true);
        }

        // Проверяем статус материала
        $is_purchased = is_purchased($post_id, $purchased_posts);
        $is_free = get_post_meta($post_id, 'free_material', true) === '1';

        // Инициализируем сервис для работы с файлами напрямую
        $pda_services = new PDA_Services();

        // Получаем информацию о ценах
        $price = get_post_meta($post_id, 'price', true);
        $discount = get_post_meta($post_id, 'without_discount_price', true);
        ?>

        <div class="prices d-flex align-items-center">
          <?php if ($is_free) : ?>
            <div class="price">Бесплатно</div>
          <?php elseif (!empty($price)) : ?>
            <div class="price"><?php echo esc_html($price . ' ₽'); ?></div>
            <?php if (!empty($discount) && $discount > $price) :
              $discount_percent = '-' . round((($discount - $price) / $discount) * 100) . '%';
            ?>
              <div class="oldprice"><?php echo esc_html($discount . ' ₽'); ?></div>
              <div class="sale"><?php echo esc_html($discount_percent); ?></div>
            <?php endif; ?>
          <?php else : ?>
            <div class="price">0 ₽</div>
          <?php endif; ?>
        </div>

        <?php
        // Показываем соответствующие кнопки в зависимости от статуса
        if ($is_purchased || $is_free || current_user_can('administrator')) :
          // Массив типов материалов
          $metodic_materials = [
            'metodic_docs' => 'Скачать DOC',
            'metodic_presentations' => 'Скачать Презентацию',
            'metodic_pdfs' => 'Скачать PDF',
            'curses_file' => 'Скачать Курс',
          ];

          foreach ($metodic_materials as $material_type => $button_text) :
            $attachments = get_post_meta($post_id, $material_type);
            if ($attachments) :
              foreach ($attachments as $attachment_id) :
                $download_link = $pda_services->generate_custom_private_link($attachment_id, null, null);
        ?>
                <a href='<?php echo esc_url($download_link); ?>'
                  class='btn-buy material-download'
                  data-post-id='<?php echo get_the_ID(); ?>'
                  download>
                  <?php echo esc_html($button_text) . '<br/>' . esc_html(get_the_title($attachment_id)); ?>
                </a>
            <?php
              endforeach;
            endif;
          endforeach;

          // Проверяем ссылку на Яндекс.Диск
          $metodic_file_url = get_post_meta($post_id, 'metodic_file_url', true);
          if ($metodic_file_url) : ?>
            <a href="<?php echo esc_url($metodic_file_url) ?>"
              class="btn-buy material-download">
              Яндекс.Диск
            </a>
          <?php endif;

        else : ?>
          <button class="btn-buy material-payment"
            data-id="<?php echo esc_attr($post_id); ?>">
            Купить материал
          </button>
        <?php endif; ?>

        <?php
        // Показываем демо-версию если есть
        $demo_attachment = get_post_meta($post_id, 'metodic_demo', true);
        if ($demo_attachment) :
          $demo_link = $pda_services->generate_custom_private_link($demo_attachment, null, null);
        ?>
          <p>
            <a href="<?php echo esc_url($demo_link); ?>"
              class="btn-buy"
              download>
              Скачать демо-версию
            </a>
          </p>
        <?php endif; ?>

        <div class="mat-info">
          <?php
          $author_id = get_the_author_meta('ID');
          $author_name = get_the_author_meta('display_name');
          ?>
          Настоящая методическая разработка
          опубликована пользователем
          <?php echo esc_html($author_name); ?>.
          Учебочка является информационным
          посредником.
        </div>

        <a href="<?php echo um_user_profile_url($author_id); ?>" class="ava d-flex align-items-center">
          <div class="img">
            <?php
            $author_avatar = get_avatar_url($author_id, array('size' => 50));
            ?>
            <img src="<?php echo esc_url($author_avatar ? $author_avatar : get_template_directory_uri() . '/img/ava.png'); ?>" alt="<?php echo esc_attr($author_name); ?>">
          </div>
          <div class="text">
            <div class="name"><?php echo esc_html($author_name); ?></div>
            <?php
            $author_posts_count = count_user_posts($author_id, ['metodic_post', 'curses_post']);
            ?>
            <div class="works">Количество работ: <?php echo $author_posts_count; ?></div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>