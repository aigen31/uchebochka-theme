<?php get_header(); ?>
</div>

<!-- TOP END -->

<section class="section-materials">
    <div class="container d-md-flex">

        <?php get_template_part('template-parts/column', 'left'); ?>

        <!-- CENTER COLUMN -->

        <div class="section-materials__materials add-material">
            <h1>Добавление методической разработки в маркетплейс</h1>

            <div class="link">
                <a href="/tehnicheskaya-podderzhka"> Нажмите, чтобы попасть в чат, где можно получить помощь методиста, дизайнера или техподдержки</a>
            </div>

            <form id="save-metodic-form" enctype="multipart/form-data">
                <input type="hidden" name="material_type" value="metodic_post">

                <div class="form-group">
                    <h3>Назовите методическую разработку</h3>
                    <p>Укажите формат, тему и возраст учеников (Например: Презентация на тему «История Древней Руси» для 5 класса)</p>
                    <input type="text" name="post_title" id="post_title" required value="">
                </div>

                <div class="form-group">
                    <h3>Добавьте описание</h3>

                    <p>Составьте описание к вашему товару. Чем подробнее - тем лучше!</p>
                    <p>За основу вы можете взять следующие пункты:</p>

                    <ul>
                        <li>- Краткое содержание (основные темы, разделы, структура).</li>
                        <li>- Назначение (для чего создан, какие задачи решает).</li>
                        <li>- Целевая аудитория (учителя, классные руководители, ученики какого возраста).</li>
                        <li>- Практическая польза (чем поможет педагогу/ученику - экономия времени,
                            готовые решения и т. д.).</li>
                        <li>- Ключевые особенности (гибкость, адаптивность, интерактивность, соответствие ФГОС)</li>
                        <li>- Уникальность (чем ваш материал отличается от аналогов)</li>
                    </ul>

                    <?php wp_editor('', 'post_content', [
                        'tinymce' => [
                            'toolbar' => 'bold,italic,underline,link,unlink,separator,alignleft,aligncenter,alignright,separator,undo,redo'
                        ],
                        'media_buttons' => false,
                        'textarea_rows' => 1
                    ]); ?>
                </div>

                <div class="form-group">
                    <div class="row post_categories__wrapper">
                        <?php
                        $args = [
                            'taxonomy' => 'metodic_category',
                            'max_visible' => 5,
                            'hide_empty' => false,
                        ];
                        $parents = [
                            11 => [
                                'title' => 'Предмет',
                                'slug' => 'categories',
                            ],
                            2 => [
                                'title' => 'Категории',
                                'slug' => 'subject',
                            ],
                            20 => [
                                'title' => 'Тип',
                                'slug' => 'type',
                            ],
                        ];
                        foreach ($parents as $parent => $data) {
                        ?>
                            <div class="col-md-4 col-12">
                                <?php
                                get_template_part('template-parts/terms', 'list', array_merge($args, [
                                    'title' => $data['title'],
                                    'parent' => $parent,
                                    'sidebar_id' => 'sidebar-' . $parent,
                                    'slug' => $data['slug'],
                                ]));
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <h3>Обложка (миниатюра)</h3>
                    <p>Добавьте обложку материала. Если макета нет, вы можете поставить на обложку
                        первый лист вашего материала. Картинка для обложки должна быть квадратной,
                        рекомендуемый размер: 1800х1800 px</p>

                    <div class="file-upload-area" data-input-name="files[]">
                        <div class="file-upload-content">
                            <div class="file-upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <p class="file-upload-text">Нажмите для загрузки обложки или перетащите файл сюда</p>
                            <p class="file-upload-hint">Рекомендуемый размер: 1800×1800 px</p>
                        </div>
                        <div class="file-names"></div>
                        <input type="file" name="post_thumbnail" class="file-input-hidden" multiple accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <h3>Файлы</h3>
                    <p>Добавьте материал в любом доступном формате. Для удобства покупателей можно
                        добавить материал в нескольких форматах (по желанию).</p>

                    <div class="form-group-in">
                        <div class="subtitle">Документы (.docx, .odt)</div>
                        <div class="file-upload-area" data-input-name="doc[]">
                            <div class="file-upload-content">
                                <div class="file-upload-icon">
                                    <i class="fas fa-file-word"></i>
                                </div>
                                <p class="file-upload-text">Загрузите документы</p>
                                <p class="file-upload-hint">.docx, .odt</p>
                            </div>
                            <div class="file-names"></div>
                            <input type="file" name="metodic_docs[]" class="file-input-hidden" accept=".docx,.odt" multiple>
                        </div>
                    </div>

                    <div class="form-group-in">
                        <div class="subtitle">Презентации (.pptx, .odp)</div>
                        <div class="file-upload-area" data-input-name="ppt[]">
                            <div class="file-upload-content">
                                <div class="file-upload-icon">
                                    <i class="fas fa-file-powerpoint"></i>
                                </div>
                                <p class="file-upload-text">Загрузите презентации</p>
                                <p class="file-upload-hint">.pptx, .odp</p>
                            </div>
                            <div class="file-names"></div>
                            <input type="file" name="metodic_presentations[]" class="file-input-hidden" accept=".pptx,.ppt,.odp" multiple>
                        </div>
                    </div>

                    <div class="form-group-in">
                        <div class="subtitle">Файлы (.pdf)</div>
                        <div class="file-upload-area" data-input-name="pdf[]">
                            <div class="file-upload-content">
                                <div class="file-upload-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <p class="file-upload-text">Загрузите PDF файлы</p>
                                <p class="file-upload-hint">.pdf</p>
                            </div>
                            <div class="file-names"></div>
                            <input type="file" name="metodic_pdfs[]" class="file-input-hidden" accept=".pdf" multiple>
                        </div>
                    </div>

                    <div class="form-group-in">
                        <div class="subtitle">Ссылка на Яндекс Диск</div>
                        <input type="text" name="yandex_disk" value="" placeholder="https://disk.yandex.ru" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <h3>Обзор и демо-версия</h3>
                    <p>Чтобы повысить доверие и интерес к товару, вы можете добавить файл с фрагментом
                        из вашего материала (например, 2-3 слайда из презентации), а также добавить ссылку
                        на Rutube или VK на видеообзор материала.</p>
                    <p>Демо-файлы для пробного доступа</p>

                    <div class="file-upload-area" data-input-name="demo[]">
                        <div class="file-upload-content">
                            <div class="file-upload-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <p class="file-upload-text">Загрузите демо-версию</p>
                            <p class="file-upload-hint">Любые форматы</p>
                        </div>
                        <div class="file-names"></div>
                        <input type="file" name="demo[]" class="file-input-hidden" multiple>
                    </div>

                    <div class="um-field um-custom-field cf-frontend-wrap">
                        <div class="cf-group">
                            <div class="cf-group__head">
                                <h4>Ссылка на видео с Rutube</h4>
                                <button type="button" class="btn btn--accent cf-add-rutube">Добавить</button>
                            </div>

                            <div class="rutube-wrapper">
                                <div class="cf-item">
                                    <div class="cf-item__fields">
                                        <label>Ссылка на видео с Rutube
                                            <input type="text" maxlength="255" name="rutube_id[]" placeholder="https://rutube.ru/video/ваш_id_видео">
                                        </label>
                                    </div>
                                    <div class="cf-item__actions">
                                        <button type="button" class="btn btn--accent cf-up">↑</button>
                                        <button type="button" class="btn btn--accent cf-down">↓</button>
                                        <button type="button" class="btn btn--accent cf-remove">Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <template id="rutube-wrapper">
                                <div class="cf-item">
                                    <div class="cf-item__fields">
                                        <label>Ссылка на видео с Rutube
                                            <input type="text" maxlength="255" name="rutube_id[]" placeholder="https://rutube.ru/video/ваш_id_видео">
                                        </label>
                                    </div>
                                    <div class="cf-item__actions">
                                        <button type="button" class="btn btn--accent cf-up">↑</button>
                                        <button type="button" class="btn btn--accent cf-down">↓</button>
                                        <button type="button" class="btn btn--accent cf-remove">Удалить</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="cf-group">
                            <div class="cf-group__head">
                                <h4>Ссылка VK Видео</h4>
                                <button type="button" class="btn btn--accent cf-add-vk-video">Добавить</button>
                            </div>

                            <div class="vk-video-wrapper">
                                <div class="cf-item">
                                    <div class="cf-item__fields">
                                        <label>Ссылка VK Видео
                                            <input type="text" maxlength="255" name="vk_video_id[]" placeholder="https://vk.com/ваш_id_видео">
                                        </label>
                                    </div>
                                    <div class="cf-item__actions">
                                        <button type="button" class="btn btn--accent cf-up">↑</button>
                                        <button type="button" class="btn btn--accent cf-down">↓</button>
                                        <button type="button" class="btn btn--accent cf-remove">Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <template id="vk-video-wrapper">
                                <div class="cf-item">
                                    <div class="cf-item__fields">
                                        <label>Ссылка VK Видео
                                            <input type="text" maxlength="255" name="vk_video_id[]" placeholder="https://vk.com/ваш_id_видео">
                                        </label>
                                    </div>
                                    <div class="cf-item__actions">
                                        <button type="button" class="btn btn--accent cf-up">↑</button>
                                        <button type="button" class="btn btn--accent cf-down">↓</button>
                                        <button type="button" class="btn btn--accent cf-remove">Удалить</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="form-group-in">
                        <div class="d-flex">
                            <label class="checkbox-label">
                                <input type="checkbox" id="free_material" name="free_material">
                                <span class="checkbox-custom"></span>
                            </label>
                            <span>Бесплатный товар</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3>Установите цену</h3>
                    <p>Пожалуйста, установите цену на свой материал, ориентируясь на рыночную стоимость
                        и его содержание. Чем лучше соотношение цены и качества, тем выше вероятность, что
                        материал будут покупать. Изменить цену можно в разделе «Методические материалы».</p>

                    <div class="price-row row">
                        <div class="col-md-6 col-12">
                            <input type="text" name="price" value="" placeholder="руб." id="priceInput">
                            <p>Вы будете получать 50% с каждой продажи методической разработки</p>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info">
                                <div class="subtitle">Примерный заработок <img src="img/que.svg" alt="" data-bs-toggle="tooltip" data-bs-placement="top" title="Калькулятор, с помощью которого вы можете посмотреть возможный доход при установленной цене и разных количествах скачиваний.
              Помните, что на объем продаж влияет качество карточки товара; стоимость; содержание и качество превью материала"></div>
                                <div class="d-flex justify-content-between">
                                    <p>Скачиваний за день:</p>
                                    <p><input type="text" name="downloads" value="30" id="downloads"></p>
                                </div>
                                <div class="price-scale" id="priceScale">
                                    <div class="circle" id="sliderCircle" style="left:50%"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Доход за месяц:</p>
                                    <p class="price-val">0</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-form">
                        После нажатия кнопки материал отправится на проверку. Если ваш товар отклонили
                        или долго не одобряют, пожалуйста, напишите в техническую поддержку. Модерация
                        занимает до 48 часов, чаще - 24 часа.
                    </div>

                    <div class="d-flex">
                        <button class="btn btn-send" id="addMaterialButton">Добавить</button>
                        <div class="agree">
                            <label>
                                <input type="checkbox" name="agree" value="1" required>
                                <span></span>
                                Принимаю правила публикации и <a href="">условия оферты</a>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- END CENTER COLUMN -->

        <div class="right-market">
            <div class="yell-block">
                <h5>Условия публикации</h5>

                <p>Перед загрузкой материала Администрация Сайта предлагает еще раз убедиться, что Ваш материал соответствует основным требованиям (выдержка из Оферты п. 2.6.):</p>

                <p>1) Материал соответствует законодательству РФ об авторском праве, не нарушает прав третьих лиц: a. При размещении материала Автор гарантирует, что материал написан им лично, он является единственным автором. b. Материал не является плагиатом.</p>

                <p>2) В Материале отсутствует реклама, ссылки на сайты и сервисы, личные данные Автора (имя, фамилия, место работы).</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>