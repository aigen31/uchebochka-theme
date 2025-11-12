<?php get_header(); ?>
</div>

<!-- TOP END -->

<section class="section-materials">
    <div class="container d-md-flex">
        <?php get_template_part('template-parts/column', 'left'); ?>

        <!-- CENTER COLUMN -->

        <div class="section-materials__materials add-material">
            <h1>Написать статью</h1>
            <form id="save-metodic-form" enctype="multipart/form-data">
                <input type="hidden" name="material_type" value="post">

                <div class="form-group">
                    <h3>Название статьи</h3>
                    <p>Описание</p>
                    <input type="text" id="post_title" name="post_title" required>
                </div>

                <div class="form-group">
                    <h3>Время прочтения</h3>
                    <p>Описание</p>
                    <div class="d-flex">
                        <input type="text" name="hour" value="" placeholder="часы">
                        <input type="text" name="min" value="" placeholder="минуты">
                    </div>
                </div>

                <div class="form-group">
                    <h3>Добавьте описание</h3>
                    <p>Описание</p>
                    <?php wp_editor('', 'post_content', [
                        'tinymce' => [
                            'toolbar' => 'bold,italic,underline,link,unlink,separator,alignleft,aligncenter,alignright,separator,undo,redo'
                        ],
                        'media_buttons' => false,
                        'textarea_rows' => 1
                    ]); ?>
                </div>


                <div class="form-group">
                    <h3>Обложка (миниатюра)</h3>
                    <p>Добавьте обложку материала. Если макета нет, вы можете поставить на обложку
                        первый лист вашего материала. Картинка для обложки должна быть квадратной,
                        рекомендуемый размер: 1800х1800 px</p>

                    <div id="file-previews" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px;"></div>

                    <div id="file-drop-zone" class="file-upload-area br_dropzone" data-input-name="files[]">
                        <div class="file-upload-content">
                            <div class="file-upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <p class="file-upload-text">Нажмите для загрузки обложки или перетащите файл сюда</p>
                            <p class="file-upload-hint">Рекомендуемый размер: 1800×1800 px</p>
                        </div>
                        <div class="file-names"></div>
                        <input type="file" name="post_thumbnail" class="file-input-hidden" accept="image/*">
                    </div>
                </div>

                <div class="form-group">
                    <h3>Текст статьи</h3>
                    <p>Описание</p>
                    <textarea name="text" id="text-tiny2" cols="30" rows="5"></textarea>
                </div>


                <div class="form-group">
                    <h3>Автор</h3>
                    <p>Описание</p>

                    <div class="form-group-in">
                        <p>Имя</p>
                        <input type="text" name="name" value="">
                    </div>

                    <div class="file-upload-area" data-input-name="files[]">
                        <div class="file-upload-content">
                            <div class="file-upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <p class="file-upload-text">Фото автора</p>
                            <p class="file-upload-hint">(jpg, jpeg)</p>
                        </div>
                        <div class="file-names"></div>
                        <input type="file" name="foto[]" class="file-input-hidden" accept="image/*">
                    </div>

                    <div class="form-group-in">
                        <p>Место работы</p>
                        <input type="text" name="work" value="">
                    </div>


                    <div class="info-form">
                        После нажатия кнопки материал отправится на проверку. Если ваш товар отклонили
                        или долго не одобряют, пожалуйста, напишите в техническую поддержку. Модерация
                        занимает до 48 часов, чаще - 24 часа.
                    </div>

                    <div class="d-flex">
                        <button id="create-new-post-submit" type="submit" class="btn btn-send">Опубликовать</button>
                        <div class="agree">
                            <label>
                                <input type="checkbox" name="agree" value="1">
                                <span></span>
                                Принимаю правила публикации и <a href="">условия оферты</a>
                            </label>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                jQuery(document).ready(function($) {
                    // Обработка drag-and-drop
                    var onDragEnter = function(event) {
                            $(".br_dropzone").addClass("dragover");
                        },
                        onDragOver = function(event) {
                            event.preventDefault();
                            if (!$(".br_dropzone").hasClass("dragover"))
                                $(".br_dropzone").addClass("dragover");
                        },
                        onDragLeave = function(event) {
                            event.preventDefault();
                            $(".br_dropzone").removeClass("dragover");
                        },
                        onDrop = function(event) {
                            $(".br_dropzone").removeClass("dragover");
                            $(".br_dropzone").addClass("dragdrop");
                            console.log(event.originalEvent.dataTransfer.files);
                        };

                    $(".br_dropzone")
                        .on("dragenter", onDragEnter)
                        .on("dragover", onDragOver)
                        .on("dragleave", onDragLeave)
                        .on("drop", onDrop);
                });

                // Обработка загрузки файлов
                function handleFileUpload(input, fileNameField, progressBarId) {
                    var files = input.files;

                    if (files.length === 0) return;

                    document.getElementById(fileNameField).value = Array.from(files).map(f => f.name).join(', ');

                    var progressBar = document.getElementById(progressBarId);
                    progressBar.style.display = 'block';
                    progressBar.value = 0;

                    var previewsContainer = document.getElementById('file-previews');
                    previewsContainer.innerHTML = '';

                    var totalFiles = files.length;
                    var loadedFiles = 0;

                    Array.from(files).forEach(function(file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            var img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '150px';
                            img.style.transform = `rotate(${Math.floor(Math.random() * 30) - 15}deg)`;
                            img.style.margin = '5px';
                            img.classList.add('preview-image');

                            previewsContainer.appendChild(img);

                            loadedFiles++;
                            progressBar.value = (loadedFiles / totalFiles) * 100;

                            if (loadedFiles === totalFiles) {
                                progressBar.value = 100;
                            }
                        };

                        reader.readAsDataURL(file);
                    });
                }
            </script>


        </div>

        <!-- END CENTER COLUMN -->

        <div class="right-market">
            <div class="yell-block">
                <h5>Условия публикации</h5>

                <p>Перед загрузкой материала Администрация Сайта предлагает еще раз убедиться, что Ваш материал соответствует основным требованиям (выдержка из Оферты п. 2.6.):</p>

                <p>1) Материал соответствует законодательству РФ об авторском праве, не нарушает прав третьих лиц: a. При размещении материала Автор гарантирует, что материал написан им лично, он является единственным автором. b. Материал не является плагиатом.</p>

                <p>2) В Материале отсутствует реклама, ссылки на сайты и сервисы, личные данные Авторы (имя, фамилия, место работы).</p>
            </div>

            <div class="rating-profile">
                <div class="subtitle">Рейтинг профиля</div>

                <p>Заполненность вашего профиля повышает доверие покупателя</p>

                <img src="img/profile-rating-low.svg" alt="">

                <div class="profile-rating__progress-comment profile-rating__progress-comment--low">
                    <p class="profile-rating__progress-text">
                        <span class="profile-rating__progress-highlight profile-rating__progress-highlight--low">Эх...</span> Будет мало продаж (
                    </p>
                    <div class="profile-rating__progress-precent">
                        10%
                    </div>
                </div>

            </div>
            <div class="rating-profile">
                <div class="subtitle">Рейтинг профиля</div>

                <p>Заполненность вашего профиля повышает доверие покупателя</p>

                <img src="img/profile-rating-medium.svg" alt="">

                <div class="profile-rating__progress-comment profile-rating__progress-comment--medium">
                    <p class="profile-rating__progress-text">
                        <span class="profile-rating__progress-highlight profile-rating__progress-highlight--medium">Ура!</span> Больше шансов, что купят!
                    </p>
                    <div class="profile-rating__progress-precent">
                        50%
                    </div>
                </div>

            </div>
            <div class="rating-profile">
                <div class="subtitle">Рейтинг профиля</div>

                <p>Заполненность вашего профиля повышает доверие покупателя</p>

                <img src="img/profile-rating-high.svg" alt="">

                <div class="profile-rating__progress-comment profile-rating__progress-comment--high">
                    <p class="profile-rating__progress-text">
                        <span class="profile-rating__progress-highlight profile-rating__progress-highlight--high">Отлично!</span> Ваш материал точно захотят приобрести!
                    </p>
                    <div class="profile-rating__progress-precent">
                        100%
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>