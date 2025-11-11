<!DOCTYPE html>
<html lang="ru-ru" dir="ltr" itemscope itemtype="https://schema.org/WebPage" prefix="og:http://ogp.me/ns#">

<head>
    <meta charset="UTF-8" />
     <meta name='viewport' content='width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'>
    <title>Add Article</title>

    <link rel="canonical" href="https://moderntemplate.site/" />
    <link rel="amphtml" href="https://moderntemplate.site/amp/index.html" />
    <link rel="icon" type="image/png" href="./img/icons/64x64.png" />
    <link rel="manifest" href="./manifest.json" />

    <!-- General -->
    <meta name="application-name" content="HTML Template" />
    <meta name="author" content="Igor Agapov" />
    <meta name="description" content="Modern HTML Starter Template" />
    <meta name="keywords" content="modern, useful, html, html5, css, css3, javascript, js, template, boilerplate" />
    <meta name="referrer" content="strict-origin" />

    <meta itemprop="name" content="HTML Template" />
    <meta itemprop="description" content="Modern HTML Starter Template" />
    <meta itemprop="image" content="./img/icons/128x128.png" />

    <!-- Microsoft -->
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="msapplication-starturl" content="/" />
    <meta name="msapplication-tooltip" content="Modern HTML Starter Template" />
    <meta name="msapplication-TileColor" content="#3c3c3c" />
    <meta name="msapplication-config" content="browserconfig.xml" />

    <!-- Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://moderntemplate.site/" />
    <meta property="og:title" content="HTML Template" />
    <meta property="og:description" content="Modern HTML Starter Template" />
    <meta property="og:image" content="./img/icons/600x600.png" />
    <meta property="og:locale" content="en_US" />

    <!-- Twitter -->
    <meta name="twitter:card" content="app" />
    <meta name="twitter:title" content="HTML Template" />
    <meta name="twitter:description" content="Modern HTML Starter Template" />
    <meta name="twitter:url" content="https://moderntemplate.site/" />
    <meta name="twitter:image" content="./img/icons/512x512.png" />

    <!-- iOS -->
    <meta name="apple-mobile-web-app-title" content="HTML Template" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#3c3c3c" />
    <link rel="apple-touch-icon" href="./img/icons/512x512.png" />

    <!-- Android -->
    <meta name="theme-color" content="#f0f0f0" />
    <meta name="color-scheme" content="light" />
    <meta name="mobile-web-app-capable" content="yes" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./src/libs/bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="./src/libs/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="./src/libs/bootstrap/css/bootstrap.min.css">


    <link rel="preload" href="./src/css/style.css" as="style" />
    <link rel="stylesheet" href="./src/css/style.css" />
    <link rel="stylesheet" href="./src/css/tablet.css" />
    <link rel="stylesheet" href="./src/css/mobile.css" />

    <link rel="preload" href="./src/js/script.js" as="script" />


    <style>
        /* Critical CSS */
    </style>
</head>

<body>
    <div class="top">
        <header class="header-main">
            <div class="container header-main__container">
                <div class="header-main__wrapper d-md-flex align-items-md-center">
                    <a href="#" class="logo header-main__logo">
                        <img src="img/header/logo.svg" alt="">
                    </a>

                    <div class="header-main__menu">
                        <ul class="menu">
                            <li class="menu-item"><a href="#">Главная</a></li>
                            <li class="menu-item menu-item-has-children">
                                <a href="#">Услуги</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="#">Дизайн</a></li>
                                    <li class="menu-item"><a href="#">Разработка</a></li>
                                </ul>
                            </li>
                            <li class="menu-item"><a href="#">Контакты</a></li>
                        </ul>
                    </div>

                    <div class="header-main__buttons">
                        <div class="btn btn--icon header-main__support-btn">
                            <span>Техническая поддержка</span>
                            <div class="header-main__support-icons">
                                <img src="img/socials/vk.svg" alt="">
                                <img src="img/socials/tg.svg" alt="">
                            </div>
                        </div>

                        <div class="links d-flex">
                            <a href="">
                                <img src="img/star-top.svg" alt="">
                            </a>
                            <a href="">
                                <img src="img/cart2.svg" alt="">
                                <span class="count">1</span>
                            </a>
                            <a href="">
                                <img src="img/lk.svg" alt="">
                                <img src="img/download.svg" alt="">
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </header>
 <header class="mob">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="/">
                            <img src="img/logo.svg" alt="">
                        </a>
                    </div>
                    <div class="pad">
                        <ul>
                            <li><a href="">Главная</a></li>
                            <li><a href="">Видеокурсы</a></li>
                            <li><a href="">Учебные материалы</a></li>
                            <li class="parent"><a href="">Блог</a> <span class="arr"><img src="img/parent-down.svg" alt=""></span>
                                <ul>
                                    <li><a href="">Кейсы педагогов</a></li>
                                    <li><a href="">Новости компании</a></li>
                                    <li><a href="">Обновление платформы</a></li>
                                    <li><a href="">Экспертные статьи</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                    <div class="burg">
                        <img src="img/burger.svg" alt="">
                    </div>
                </div>

            </div>

        </header>

        <!--- burger menu -->

        <div class="burger-menu" style="display:none;">
            <div class="container">
                <div class="item">
                    <div class="close-burger">
                        <img src="img/close-menu.svg" alt="">
                    </div>

                    <ul>
                        <li><a href="">Главная</a></li>
                        <li><a href="">Видеокурсы</a></li>
                        <li><a href="">Учебные материалы</a></li>
                        <li class="parent"><a href="">Блог</a> <span class="arr"><img src="img/parent-down.svg" alt=""></span>
                            <ul>
                                <li><a href="">Кейсы педагогов</a></li>
                                <li><a href="">Новости компании</a></li>
                                <li><a href="">Обновление платформы</a></li>
                                <li><a href="">Экспертные статьи</a></li>
                            </ul>
                        </li>

                    </ul>

                    <ul>
                        <li><a href="">Регистрация</a></li>
                        <li><a href="">Вход</a></li>
                        <li><a href="">Техническая помощь</a></li>
                    </ul>

                    <div class="header-main__support-icons">
                        <a href="" target="_blank"><img src="img/socials/vk.svg" alt=""></a>
                        <a href="" target="_blank"><img src="img/socials/tg.svg" alt=""></a>
                    </div>


                </div>
            </div>
        </div>

        <!--- pad menu -->

        <div class="pad-menu" style="display:none;">
            <ul>
                <li><a href="">Регистрация</a></li>
                <li><a href="">Вход</a></li>
                <li><a href="">Техническая помощь</a></li>
            </ul>
            <div class="header-main__support-icons">
                <a href="" target="_blank"><img src="img/socials/vk.svg" alt=""></a>
                <a href="" target="_blank"><img src="img/socials/tg.svg" alt=""></a>
            </div>
        </div> 



        <!-- bottom fixed menu -->

        <div class="bottom-menu mob">
            <ul>
                <li><a href="/"><img src="img/home.svg" alt=""></a></li>
                <li class="filter-call"><a><img src="img/set2.svg" alt=""></a></li>
                <li class="lk-button"><a href="" data-bs-toggle="modal" data-bs-target="#consultModal"><img src="img/lk.svg" alt=""></a></li>
                <li><a href=""><img src="img/star-top.svg" alt=""></a></li>
                <li><a href="">
                        <img src="img/cart2.svg" alt="">
                        <span class="count">1</span>
                    </a></li>
            </ul>
        </div>

    </div>


    <section class="section-materials">
        <div class="container d-md-flex">

            <!-- SIDEBAR -->

            <div class="section-materials__sidebar">

                <div class="section-materials__authentication lk">
                    <div class="section-materials__authentication-tabs">
                        <div class="section-materials__authentication-tab section-materials__authentication-tab--login">
                            Личный кабинет
                        </div>
                        <div class="section-materials__authentication-tab section-materials__authentication-tab--registration">
                            Баланс: <span>0 ₽</span>
                        </div>
                    </div>
                    <div class="lk-tab">
                        <div class="avatar">
                            <img src="img/ava.png" alt="">
                            <div class="name">Иван Иванов</div>
                        </div>
                        <div class="lk-menu">
                            <ul>
                                <li><a href=""><img src="img/uch.svg" alt=""> Учетная запись</a></li>
                                <li><a href=""><img src="img/pub.svg" alt=""> Публикации</a></li>
                                <li><a href=""><img src="img/mat.svg" alt=""> Материалы</a></li>
                                <li><a href=""><img src="img/chat.png" alt=""> Сообщения</a></li>
                                <li class="exit"><a href=""><img src="img/exit.svg" alt=""> Выйти</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- widget vk -->


            </div>


            <!-- END SIDEBAR -->


            <!-- CENTER COLUMN -->

            <div class="section-materials__materials add-material">



                <h1>Написать статью</h1>



                <form action="">
                    <div class="form-group">
                        <h3>Название статьи</h3>
                        <p>Описание</p>
                        <input type="text" name="name" value="">
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
                        <textarea name="text" id="text-tiny" cols="30" rows="5"></textarea>
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
                            <input type="file" name="files[]" class="file-input-hidden" accept="image/*">
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
                            <button class="btn btn-send">Опубликовать</button>
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


            </div>

            <!-- END CENTER COLUMN -->

            <div class="right-market">
                <div class="yell-block">
                    <h5>Условия публикации</h5>

                    <p>Перед загрузкой материала Администрация Сайта предлагает еще раз убедиться, что Ваш материал соответствует основным требованиям (выдержка из Оферты п. 2.6.):</p>

                    <p>1) Материал соответствует законодательству РФ об авторском праве, не нарушает прав третьих лиц: a. При размещении материала Автор гарантирует, что материал написан им лично, он является единственным автором. b. Материал не является плагиатом.</p>

                    <p>2) В Материале отсутствует реклама, ссылки на сайты и сервисы, личные данные Автора (имя, фамилия, место работы).</p>
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


    <footer>
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="logo">
                        <img src="img/logo2.svg" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    <nav>
                        <ul>
                            <li><a href="">Разместить рекламу</a></li>
                            <li><a href="">Главная</a></li>
                            <li><a href="">Видеокурсы</a></li>
                            <li><a href="">Учебные материалы</a></li>
                            <li><a href="">Блог</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="copy">
                        <p>Ответственность за разрешение любых спорных моментов, касающихся самих материалов и их содержания, берут на себя пользователи, разместившие материал на сайте. Однако администрация сайта готова оказать всяческую поддержку в решении любых вопросов, связанных с работой и содержанием сайта. Если Вы заметили, что на данном сайте незаконно используются материалы, сообщите об этом администрации сайта через форму обратной связи.</p>

                        <p>Все материалы, размещенные на сайте, созданы авторами сайта либо размещены пользователями сайта и представлены на сайте исключительно для ознакомления. Авторские права на материалы принадлежат их законным авторам. Частичное или полное копирование материалов сайта без письменного разрешения администрации сайта запрещено! Мнение администрации может не совпадать с точкой зрения авторов.</p>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-5 col-md-6 col-12">
                    <div class="d-flex">
                        <div class="menu col-md-6 col-12">
                            <nav>
                                <ul>
                                    <li><a href="">Сведения об организации</a></li>
                                    <li><a href="">Пользовательское соглашение</a></li>
                                    <li><a href="">Политика конфиденциальности</a></li>
                                    <li><a href="">Политика персональных данных</a></li>
                                </ul>
                            </nav>

                            <div class="copyright">
                                &copy; Все права защищены, 2025 г.
                            </div>
                        </div>
                        <div class="marketing col-md-6 col-12">
                            <p>По вопросам рекламы:</p>
                            <p><a href="tel:">+7 999 999 99 99</a></p>
                            <p><a href="mailto:">mail@mail.ru</a></p>
                            <div class="soc">
                                <a href="" target="_blank"><img src="img/socials/vk.svg" alt=""></a>
                                <a href="" target="_blank"><img src="img/socials/tg.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </footer>

    <div class="modal fade" id="consultModal" tabindex="-1" aria-labelledby="consultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="img/close.svg" alt="">
                </button>
                <div class="modal-body">

                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="tel" class="form-control" id="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Ваш запрос или предложение</label>
                            <textarea class="form-control" id="message" rows="3"></textarea>
                        </div>
                        <p>Мы открыты к обсуждению
                            разных форматов сотрудничества!
                            Оставьте заявку и мы свяжемся
                            с вами в ближайшее время.</p>
                        <button type="submit" class="btn btn-submit">Отправить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="src/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/main.js"></script>
</body>

</html>