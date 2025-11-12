<?php
get_header();
?>
</div>

<!-- TOP END -->

<section class="section-materials">
    <div class="container d-md-flex">
        <?php get_template_part('template-parts/column', 'left'); ?>

        <!-- CENTER COLUMN -->

        <?php display_is_user_logged_in('template-parts/profile'); ?>
    </div>
</section>


<?php get_footer(); ?>