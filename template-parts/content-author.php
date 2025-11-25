<?
use Uchebochka\UserWrapper;
try{
    $userWrapper = new UserWrapper($user_login);
    $userData = $userWrapper->getUserData();
    $userAwatar = get_avatar_url($userData->user_email, ['size' => 100]);
}catch(\Exception $e){
    $userWrapper = false;
    $errorMessage = $e->getMessage();
}
?>
<?if(!$userWrapper):?>
  <div class="section-materials__materials add-material">
       <?=$errorMessage?>
    </div>
<?else:?>
<div class="section-materials__materials add-material">
    <div class="bread">
         <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<nav class="breadcrumb">','</nav>');
        } ?>
    </div>
    <div class="profile">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-12">
                <div class="ava">
                    <img src="<?=$userAwatar?>" alt="<?=$userData->first_name?> <?=$userData->last_name?>">
                </div>
            </div>
            <div class="col-lg-8 col-md-7 col-12">
                <div class="d-flex justify-content-between">
                    <div class="name"><?=$userData->first_name?> <?=$userData->last_name?></div>
                </div>

                <div class="social">
                    <?if($userData->vkprofile):?>
                        <a href="<?=$userData->vkprofile?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/vk2.svg" alt="vk"></a>
                    <?endif;?>
                     <?if($userData->tgprofile):?>
                        <a href="<?=$userData->tgprofile?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/tg2.svg" alt="tg"></a>
                    <?endif;?>
                </div>

                <div class="info-block">
                    <?if($userData->position):?>
                    <div class="item">
                        <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.25 0.25C9.58152 0.25 9.89946 0.381696 10.1339 0.616116C10.3683 0.850537 10.5 1.16848 10.5 1.5V11.5C10.5 11.8315 10.3683 12.1495 10.1339 12.3839C9.89946 12.6183 9.58152 12.75 9.25 12.75H1.75C1.41848 12.75 1.10054 12.6183 0.866116 12.3839C0.631696 12.1495 0.5 11.8315 0.5 11.5V1.5C0.5 1.16848 0.631696 0.850537 0.866116 0.616116C1.10054 0.381696 1.41848 0.25 1.75 0.25H9.25ZM9.25 1.5H6.125V6.5L4.5625 5.09375L3 6.5V1.5H1.75V11.5H9.25V1.5Z" fill="#BBBBBB"></path>
                        </svg>
                        <span><?=$userData->position?></span>
                    </div>
                    <?endif;?>
                    <!--TODO:<div class="item">
                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.5 1.25C5.17392 1.25 3.90215 1.77678 2.96447 2.71447C2.02678 3.65215 1.5 4.92392 1.5 6.25C1.5 7.4325 1.75125 8.20625 2.4375 9.0625L6.5 13.75L10.5625 9.0625C11.2488 8.20625 11.5 7.4325 11.5 6.25C11.5 4.92392 10.9732 3.65215 10.0355 2.71447C9.09785 1.77678 7.82608 1.25 6.5 1.25Z" stroke="#BBBBBB" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Место работы не указано</span>
                    </div> -->
                    <?if($userData->education):?>
                        <div class="item">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.95 8.25H6.05V4.95H4.95V8.25ZM5.5 3.85C5.65583 3.85 5.78655 3.7972 5.89215 3.6916C5.99775 3.586 6.05036 3.45547 6.05 3.3C6.04963 3.14453 5.99683 3.014 5.8916 2.9084C5.78636 2.8028 5.65583 2.75 5.5 2.75C5.34416 2.75 5.21363 2.8028 5.1084 2.9084C5.00316 3.014 4.95036 3.14453 4.95 3.3C4.94963 3.45547 5.00243 3.58618 5.1084 3.69215C5.21436 3.79812 5.3449 3.85073 5.5 3.85ZM5.5 11C4.73916 11 4.02417 10.8555 3.355 10.5666C2.68583 10.2777 2.10375 9.88588 1.60875 9.39125C1.11375 8.89661 0.721967 8.31453 0.4334 7.645C0.144834 6.97546 0.000367363 6.26046 6.96202e-07 5.5C-0.00036597 4.73953 0.144101 4.02453 0.4334 3.355C0.7227 2.68547 1.11448 2.10338 1.60875 1.60875C2.10302 1.11412 2.6851 0.722333 3.355 0.4334C4.0249 0.144467 4.7399 0 5.5 0C6.2601 0 6.9751 0.144467 7.645 0.4334C8.31489 0.722333 8.89698 1.11412 9.39125 1.60875C9.88551 2.10338 10.2775 2.68547 10.5671 3.355C10.8568 4.02453 11.0011 4.73953 11 5.5C10.9989 6.26046 10.8544 6.97546 10.5666 7.645C10.2788 8.31453 9.88698 8.89661 9.39125 9.39125C8.89551 9.88588 8.31343 10.2778 7.645 10.5671C6.97656 10.8564 6.26156 11.0007 5.5 11ZM5.5 9.9C6.72833 9.9 7.76875 9.47375 8.62124 8.62125C9.47374 7.76875 9.89999 6.72833 9.89999 5.5C9.89999 4.27167 9.47374 3.23125 8.62124 2.37875C7.76875 1.52625 6.72833 1.1 5.5 1.1C4.27166 1.1 3.23125 1.52625 2.37875 2.37875C1.52625 3.23125 1.1 4.27167 1.1 5.5C1.1 6.72833 1.52625 7.76875 2.37875 8.62125C3.23125 9.47375 4.27166 9.9 5.5 9.9Z" fill="#BBBBBB"></path>
                            </svg>
                            <span><?=$userData->education?></span>
                        </div>
                    <?endif;?>
                    <?if($userData->description):?>
                    <div class="item">
                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.95 8.25H6.05V4.95H4.95V8.25ZM5.5 3.85C5.65583 3.85 5.78655 3.7972 5.89215 3.6916C5.99775 3.586 6.05036 3.45547 6.05 3.3C6.04963 3.14453 5.99683 3.014 5.8916 2.9084C5.78636 2.8028 5.65583 2.75 5.5 2.75C5.34416 2.75 5.21363 2.8028 5.1084 2.9084C5.00316 3.014 4.95036 3.14453 4.95 3.3C4.94963 3.45547 5.00243 3.58618 5.1084 3.69215C5.21436 3.79812 5.3449 3.85073 5.5 3.85ZM5.5 11C4.73916 11 4.02417 10.8555 3.355 10.5666C2.68583 10.2777 2.10375 9.88588 1.60875 9.39125C1.11375 8.89661 0.721967 8.31453 0.4334 7.645C0.144834 6.97546 0.000367363 6.26046 6.96202e-07 5.5C-0.00036597 4.73953 0.144101 4.02453 0.4334 3.355C0.7227 2.68547 1.11448 2.10338 1.60875 1.60875C2.10302 1.11412 2.6851 0.722333 3.355 0.4334C4.0249 0.144467 4.7399 0 5.5 0C6.2601 0 6.9751 0.144467 7.645 0.4334C8.31489 0.722333 8.89698 1.11412 9.39125 1.60875C9.88551 2.10338 10.2775 2.68547 10.5671 3.355C10.8568 4.02453 11.0011 4.73953 11 5.5C10.9989 6.26046 10.8544 6.97546 10.5666 7.645C10.2788 8.31453 9.88698 8.89661 9.39125 9.39125C8.89551 9.88588 8.31343 10.2778 7.645 10.5671C6.97656 10.8564 6.26156 11.0007 5.5 11ZM5.5 9.9C6.72833 9.9 7.76875 9.47375 8.62124 8.62125C9.47374 7.76875 9.89999 6.72833 9.89999 5.5C9.89999 4.27167 9.47374 3.23125 8.62124 2.37875C7.76875 1.52625 6.72833 1.1 5.5 1.1C4.27166 1.1 3.23125 1.52625 2.37875 2.37875C1.52625 3.23125 1.1 4.27167 1.1 5.5C1.1 6.72833 1.52625 7.76875 2.37875 8.62125C3.23125 9.47375 4.27166 9.9 5.5 9.9Z" fill="#BBBBBB"></path>
                        </svg>
                        <span><?=$userData->description ?></span>
                    </div>
                    <?endif;?>
                </div>
            </div>
        </div>
    </div>

    <div class="info-user">
        <div class="item mat">
            <div class="num"><?=$userWrapper->getMaterialCount()?></div>
            Материалов добавлено
        </div>
        <!--TODO:   <div class="item rate">
            <div class="num">1543</div>
            Рейтинг
        </div> -->
            <!--TODO:  <div class="item followers">
            <div class="num">5</div>
            Подписчики
        </div> -->
        <div class="item date">
            Продавец
            на платформе
            с <?=(new DateTime($userData->user_registered))->format('d.m.Y');?>
        </div>
    </div>

    <?
    $materials = $userWrapper->getMaterials();
    if($materials):?>
    <div class="materials">
        <h2>Опубликованные материалы</h2>
        <?foreach($materials as $post){
            $post->author_avatar = $userAwatar;
            setup_postdata($post);
            get_template_part('template-parts/content', 'listmaterials');
        }
        wp_reset_postdata();
        ?>
    </div>
    <?endif;?>
</div>
<?endif;?>