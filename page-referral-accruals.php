<?php
get_header();
?>
<section class="section-materials">
	<div class="container d-md-flex">
		<?php get_template_part('template-parts/column', 'left'); ?>

		<?php display_is_user_logged_in('template-parts/referral-accruals', ''); ?>
	</div>
</section>
<?php
get_footer();
