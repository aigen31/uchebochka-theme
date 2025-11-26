<div class="item">
    <div class="row">
        <div class="col-md-3 col-12">
            <img src="<?=$post->author_avatar?>" alt="<?=get_the_title()?>">
        </div>
        <div class="col-md-6 col-12">
            <div class="d-flex flex-column justify-content-between h-100">
                <div class="text">
                    <div class="subtitle">
                        <a href="<?=get_the_permalink()?>"><?=get_the_title()?></a>
                    </div>
                    <p><?=get_the_excerpt()?></p>
                </div>
                <!--TODO: <div class="status">
                    Статус
                </div>-->
            </div>
        </div>
        <div class="col-md-3 col-12">
            <!--TODO: <a href="" class="btn btn-del">Удалить</a>-->
            <!--TODO: <a href="" class="btn btn-edit">Редактировать</a>-->
            <a href="<?=get_the_permalink()?>" class="btn btn-go">Перейти к публикации</a>
        </div>
    </div>
</div>