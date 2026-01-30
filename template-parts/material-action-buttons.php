<?php
$post_id = get_the_ID();

if ($args['is_purchased'] || $args['is_free'] || current_user_can('administrator')) :
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
        $download_link = $args['pda_services']->generate_custom_private_link($attachment_id, null, null);
?>
        <a href='<?php echo esc_url($download_link); ?>'
          class='btn btn-buy material-download'
          data-post-id='<?php echo get_the_ID(); ?>'
          download>
          <div class="btn-buy__text"><?php echo esc_html($button_text); ?></div>
          <div class="btn-buy__filename"><?php echo esc_html(get_the_title($attachment_id)); ?></div>
        </a>
    <?php
      endforeach;
    endif;
  endforeach;

  $metodic_file_url = get_post_meta($post_id, 'metodic_file_url', true);
  if ($metodic_file_url) : ?>
    <a href="<?php echo esc_url($metodic_file_url) ?>"
      class="btn btn-buy material-download">
      Яндекс.Диск
    </a>
  <?php endif;

else : 
  $price = get_post_meta($post_id, 'price', true);
  $title = get_the_title($post_id);
?>
  <button class="btn btn-buy material-instant-purchase"
    data-id="<?php echo esc_attr($post_id); ?>"
    data-title="<?php echo esc_attr($title); ?>"
    data-price="<?php echo esc_attr($price); ?>">
    Купить материал
  </button>
  <button class="btn btn-buy btn-buy--secondary material-payment"
    data-id="<?php echo esc_attr($post_id); ?>">
    В корзину
  </button>
<?php endif; ?>