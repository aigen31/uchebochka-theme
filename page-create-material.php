<?php get_header(); ?>
</div>

<!-- TOP END -->

<section class="section-materials">
    <div class="container d-md-flex">
        <?php get_template_part('template-parts/column', 'left'); ?>

        <?php display_is_user_logged_in('template-parts/create-material', null, ['message' => '<p>Чтобы добавить новый материал, пожалуйста, <a href="/login" class="page-message__link">войдите</a> или <a href="/register" class="page-message__link">зарегистрируйтесь</a> на платформе</p><p><a href="https://disk.yandex.ru/d/88Nr7eaX-AdAAg" class="page-message__link" target="_blank">Скачать инструкцию по регистрации и загрузке материала</a></p>']); ?>
    </div>
</section>

<?php get_footer(); ?>