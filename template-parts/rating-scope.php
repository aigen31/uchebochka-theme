<?php if (have_scope()): ?>
  <img src="<?php echo get_template_directory_uri(); ?>/img/star1.svg" alt="">
  <span><?php the_scope(); ?></span>
<?php else: ?>
  <span>Нет оценок</span>
<?php endif; ?>