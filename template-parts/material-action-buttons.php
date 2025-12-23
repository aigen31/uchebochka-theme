<?php
$post_id = get_the_ID();

if ($args['is_purchased'] || $args['is_free'] || current_user_can('administrator')):
  $metodic_materials = [
    'metodic_docs' => 'Скачать DOC',
    'metodic_presentations' => 'Скачать Презентацию',
    'metodic_pdfs' => 'Скачать PDF',
    'curses_file' => 'Скачать Курс',
  ];
  if($args['metodic_material_once']){
    $metodic_materials = $args['metodic_material_once'];
  }

  foreach ($metodic_materials as $material_type => $button_text):
    $attachments = get_post_meta($post_id, $material_type);

    if ($attachments):
      foreach ($attachments as $attachment_id):
        try {
          $attachment_id = intval($attachment_id);
          if(!$args['metodic_material_once'])
          $download_link = $args['pda_services']->generate_custom_private_link($attachment_id, null, null);
          ?>
          <div class='btn-buy <?php echo $material_type ?>'
            data-post-id='<?php echo get_the_ID(); ?>' download data-file-id="<?php echo $attachment_id?>">
            <div class="btn-buy__text"><?php echo esc_html($button_text); ?></div>
            <div class="btn-buy__filename"><?php echo esc_html(get_the_title($attachment_id)); ?></div>
            <div class="remove">XXX</div>
</div>
          <?php
        } catch (Exception $e) {
          ?>
           <span>Некоторые файлы не были отображены. Обратитесь к администратору сайта.</span>
          <?
        }
      endforeach;
    endif;
  endforeach;
  if($args['metodic_material_once']){
    return;
  }
  $metodic_file_url = get_post_meta($post_id, 'metodic_file_url', true);
  if ($metodic_file_url): ?>
    <a href="<?php echo esc_url($metodic_file_url) ?>" class="btn-buy material-download">
      Яндекс.Диск
    </a>
  <?php endif;

else: ?>
  <button class="btn-buy material-payment" data-id="<?php echo esc_attr($post_id); ?>">
    Купить материал
  </button>
<?php endif; ?>