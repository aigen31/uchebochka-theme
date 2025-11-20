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
          class='btn-buy material-download'
          data-post-id='<?php echo get_the_ID(); ?>'
          download>
          <?php echo esc_html($button_text); ?>
        </a>
    <?php
      endforeach;
    endif;
  endforeach;

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