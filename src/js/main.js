jQuery(function ($) {
    $(".faq ul li").click(function () {
        $(this).toggleClass('active');
        $(this).find('.faq-text').slideToggle();
    });

    $(".inputs .but").click(function () {
        $(this).toggleClass('active');
        $(this).siblings('.inputs-hid').slideToggle();
    });

    $(".filter-call").click(function () {
        $(this).toggleClass('active');
        $('.section-materials__filter').slideToggle();
    });

    $(".filter-close").click(function () {
        $(this).toggleClass('active');
        $('.section-materials__filter').slideToggle();

    });

    $(".burg").click(function () {
        $(this).toggleClass('active');
        $('.burger-menu').slideToggle();
    });

    $(".close-burger").click(function () {
        $(this).toggleClass('active');
        $('.burger-menu').slideToggle();

    });

    $('.paid-materials-filter__block .show-more').on('click', function () {
        $('.paid-materials-filter__sidebar').each(function () {
            $(this).hide();
        })
        var sidebarId = $(this).data('sidebar-id');
        var sidebar = $('#' + sidebarId);

        if (sidebar.length) {
            $('#' + sidebarId).show();
        } else {
            console.log('Sidebar with ID ' + sidebarId + ' not found.');
        }
    });

    $('.paid-materials-filter__check-input').on('change', function () {
        var checkboxId = $(this).data('id');
        var matchingCheckbox = $('.paid-materials-filter__check-input[data-id="' + checkboxId + '"]');

        if (matchingCheckbox.length) {
            matchingCheckbox.prop('checked', $(this).prop('checked'));
        }
    });

    $('#search-course-form input[name="searchQuery"]').on('input', function () {
        var query = $(this).val();

        if (query.length >= 3) { // Минимальная длина запроса для начала поиска
            $.ajax({
                url: ajax_filter_params.ajax_url, // URL для отправки запроса (определяется в WordPress)
                type: 'POST',
                data: {
                    action: 'search_courses', // Название действия для AJAX-хука
                    searchQuery: query
                },
                success: function (data) {
                    var resultsContainer = $('.v-search-result');
                    resultsContainer.html(data);
                    resultsContainer.show();
                }
            });
        } else {
            $('.v-search-result').hide();
        }
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.paid-materials-filter__sidebar').length && !$(e.target).closest('.show-more').length) {
            $('.paid-materials-filter__sidebar').hide();
        }
    });
});

jQuery(document).ready(function ($) {
    class Slider {
        constructor() {
            this.currentSlide = 0;
            this.slides = $('.slide');
            this.thumbnails = $('.thumbnail');
            this.totalSlides = this.slides.length;

            this.init();
        }

        init() {
            // Инициализация событий
            this.bindEvents();
            this.updateSlider();
        }

        bindEvents() {
            const self = this;
            
            //Выключаем навигацию если мало слайдов
            if(this.totalSlides < 2){
                  $('.prev-arrow').remove();
                  $('.next-arrow').remove();
                  return;
            }
            // Стрелки навигации
            $('.prev-arrow').on('click', function () {
                self.prevSlide();
            });

            $('.next-arrow').on('click', function () {
                self.nextSlide();
            });

            // Клик по миниатюрам
            this.thumbnails.on('click', function () {
                const index = $(this).data('index');
                self.goToSlide(index);
            });

            // Клавиатура
            $(document).on('keydown', function (e) {
                if (e.keyCode === 37) { // Стрелка влево
                    self.prevSlide();
                } else if (e.keyCode === 39) { // Стрелка вправо
                    self.nextSlide();
                }
            });

            // Автопрокрутка (опционально)
            // this.startAutoPlay();
        }

        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            this.updateSlider();
        }

        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.updateSlider();
        }

        goToSlide(index) {
            this.currentSlide = index;
            this.updateSlider();
        }

        updateSlider() {
            // Обновляем основной слайдер
            this.slides.removeClass('active');
            this.slides.eq(this.currentSlide).addClass('active');

            // Обновляем миниатюры
            this.thumbnails.removeClass('active');
            this.thumbnails.eq(this.currentSlide).addClass('active');
        }

        startAutoPlay() {
            // Автопрокрутка каждые 5 секунд
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, 5000);
        }

        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
            }
        }
    }

    // Инициализация слайдера
    const slider = new Slider();

    // Обработка ресайза окна для адаптивности
    let resizeTimer;
    $(window).on('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            // Дополнительные действия при ресайзе, если нужны
        }, 250);
    });

    $('#filter-form').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        console.log(formData);

        $.ajax({
            url: ajax_filter_params.ajax_url + '?' + formData + '&action=filter_posts',
            type: 'GET',
            success: function (response) {
                $('#catalog').html(response);
                var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + formData;
                window.history.pushState({ path: newUrl }, '', newUrl);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });

    function update_products_count(callback) {
        $.ajax({
            url: uchebochka_vars.rest_url + 'uchebka/v1/get_products_count',
            method: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
            },
            success: function (response) {
                callback(response)
            }
        })
    }

    $('.material-payment').on('click', function (event) {
        event.preventDefault();
        var productId = $(this).data('id');
        var $this = $(this);

        if (uchebochka_user.is_logged_in) {
            $.ajax({
                method: 'POST',
                url: uchebochka_vars.rest_url + 'uchebka/v1/insert_product_to_cart',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
                },
                data: {
                    product_id: productId,
                },
                success: function (response) {
                    console.log('ПОСТ ПРОШЁЛ');
                    if (response.status === 'success') {
                        console.log('УДАЧНО');
                        $this.text('Перейти');
                        update_products_count(function (response) {
                            $('.cart__count').text(response);
                        });
                        $this.attr('href', '/cart');
                        $this.off('click');
                    } else {
                        alert('Произошла ошибка при добавлении товара в корзину.');
                    }
                },
            })
        } else {
            alert('Пожалуйста, войдите или зарегистрируйтесь, чтобы совершить оплату.');
        }
    })

    function bindItem($item) {
        $item.find('.cf-remove').off('click').on('click', function () {
            $(this).closest('.cf-item').remove();
        });
        $item.find('.cf-up').off('click').on('click', function () {
            var $it = $(this).closest('.cf-item');
            var $prev = $it.prev('.cf-item');
            if ($prev.length) {
                $it.insertBefore($prev);
            }
        });
        $item.find('.cf-down').off('click').on('click', function () {
            var $it = $(this).closest('.cf-item');
            var $next = $it.next('.cf-item');
            if ($next.length) {
                $next.insertBefore($it);
            }
        });
    }

    $('.cf-item').each(function () {
        bindItem($(this));
    });

    function initAddButton($button, $wrapId, templateId) {
        $($button).on('click', function () {
            var $wrap = $($wrapId);
            var html = $(templateId).html();
            var $node = $(html);
            $wrap.append($node);
            bindItem($node);
        });
    }

    fields = [
        { button: '.cf-add-training', wrap: '.advanced-training-wrapper', template: '#tpl-advanced-training-item' },
        { button: '.cf-add-work', wrap: '.work-wrapper', template: '#tpl-work-item' },
        { button: '.cf-add-rutube', wrap: '.rutube-wrapper', template: '#rutube-wrapper' },
        { button: '.cf-add-vk-video', wrap: '.vk-video-wrapper', template: '#vk-video-wrapper' }
    ];

    fields.forEach(function (field) {
        initAddButton(field.button, field.wrap, field.template);
    });

    $('#apply-filter').on('click', function () {
        $('.section-materials__filter').slideToggle();
    })

    $("#save-metodic-form").on("submit", function (e) {
        e.preventDefault();
        e.stopPropagation();

        if (typeof tinyMCE !== 'undefined') {
            tinyMCE.triggerSave(); // Ensure the editor content is saved to the textarea
        }

        var formData = new FormData($(this)[0]);
        var yandexDiskLink = formData.get("yandex_disk");


        if (yandexDiskLink) {
            const value = yandexDiskLink.trim();
            if (!value.startsWith("https://disk.yandex.ru/") || value === "") {
                alert("Ссылка должна начинаться с домена https://disk.yandex.ru/");
                return;
            }
        }

        // $("#loader").show();

        function buttonActive() {
            $('#addMaterialButton').text('Добавить').prop('disabled', false);
        }

        function buttonInactive() {
            $('#addMaterialButton').text('Добавление...').prop('disabled', true);
        }

        buttonInactive();

        $.ajax({
            method: "POST",
            url: '/wp-json/urok/save_metodic',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
            },
            data: formData,
            success: function (response) {
                // $("#loader").hide();
                if (response.success) {
                    buttonActive()
                    console.log('Material added successfully');
                    window.location.href = '/thank-you';
                }
            },
            error: function (response) {
                buttonActive()
                var response = response.responseJSON;
                alert(response.error);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    jQuery.fn.fadeRemove = function (duration = 350) {
        return this.each(function () {
            $(this).fadeOut(duration, function () {
                $(this).remove();
            });
        });
    };

    $('.cart-item-remove').on('click', function () {
        var productId = $(this).data('product-id');
        var cartItem = $(this).closest('.cart-item');
        var price = cartItem.find('.cart-item-price').text().trim();
        var total = parseFloat($('.balance-amount').text().trim()) - parseFloat(price);
        $.ajax({
            url: '/wp-json/uchebka/v1/delete_product_from_cart',
            method: 'POST',
            data: {
                id: productId
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
            },
            success: function (response) {
                cartItem.fadeRemove();
                $('.balance-amount').text(total.toFixed(2) + ' ₽');
                if ($('.cart-item').length === 0) {
                    $('.cart-actions__form').fadeRemove();
                    $('.cart-clear-btn').fadeRemove();
                }
            },
            error: function () {
                alert('Ошибка при удалении товара из корзины.');
            }
        });
    });

    $('.cart-clear-btn').on('click', function () {
        if (confirm('Вы уверены, что хотите очистить корзину?')) {
            $.ajax({
                url: '/wp-json/uchebka/v1/clear_cart',
                method: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
                },
                success: function (response) {
                    $('.cart-item').each(function () {
                        $(this).fadeRemove();
                    });
                    $('.balance-amount').text('0.00 ₽');
                    $('.cart-actions__form').fadeRemove();
                    $('.cart-clear-btn').fadeRemove();
                },
                error: function (e) {
                    console.log(e);
                    alert('Ошибка при очистке корзины22.');
                }
            });
        }
    });

    $('.cart-checkout-btn').on('click', function () {
        $.ajax({
            url: '/wp-json/uchebka/v1/checkout',
            method: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
            },
            data: {
                'title': 'Оплата товаров Учебочка',
            }
        })
    })

    function historyTable(tableClass, tableSelector, paginationSelector, requestUrl) {
        var userId = uchebochka_user.id;
        var perPage = 5;
        var currentPage = 1;

        function createTable(data, tableClass, tableSelector, paginationSelector, page, totalPages) {
            if (data.length > 0) {
                var html = `<table class="${tableClass}"><thead><tr><th>Дата</th><th>Сумма</th></tr></thead><tbody>`;
                $.each(data, function (index, row) {
                    html += '<tr><td>' + row.date + '</td><td>' + row.amount + ' ₽</td></tr>';
                });
                html += '</tbody></table>';
                tableSelector.html(html);

                var pagHtml = '';
                if (page > 1) {
                    pagHtml += `<button class="pagination-prev btn btn--accent btn--small">Назад</button> `;
                }
                pagHtml += 'Страница ' + page + ' из ' + totalPages;
                if (page < totalPages) {
                    pagHtml += ` <button class="pagination-next btn btn--accent btn--small">Вперед</button>`;
                }
                paginationSelector.html(pagHtml);

                paginationSelector.off('click').on('click', '.pagination-prev', function () {
                    if (currentPage > 1) {
                        currentPage--;
                        loadPaymentHistory(currentPage);
                    }
                }).on('click', '.pagination-next', function () {
                    if (currentPage < totalPages) {
                        currentPage++;
                        loadPaymentHistory(currentPage);
                    }
                });
            } else {
                tableSelector.html('<p>У Вас пока нет платежей.</p>');
                paginationSelector.html('');
            }
        }

        function loadPaymentHistory(page) {
            tableSelector.html('<p>Загрузка...</p>');
            $.ajax({
                url: requestUrl,
                headers: {
                    'X-WP-Nonce': uchebochka_vars.nonce
                },
                method: 'GET',
                data: { page: page, per_page: perPage },
                dataType: 'json',
                success: function (resp) {
                    console.log(resp);
                    createTable(
                        resp.data || [],
                        tableClass,
                        tableSelector,
                        paginationSelector,
                        page,
                        resp.total_pages || 1
                    );
                },
                error: function () {
                    tableSelector.html('<p>Ошибка загрузки истории платежей.</p>');
                }
            });
        }

        loadPaymentHistory(currentPage);
    };

    historyTable(
        'payment-history-table',
        $('#payment-history-table-placeholder'),
        $('#payment-history-pagination'),
        '/wp-json/urok/get_user_payment_history'
    );

    historyTable(
        'accrual-history-table',
        $('#accrual-history-table-placeholder'),
        $('#accrual-history-pagination'),
        '/wp-json/urok/get_user_accrual_history',
    );

    $('.section-materials__filter .show-more').click(function (e) {
        e.preventDefault();
        $(this).siblings('.filter-options').find('.filter-option.switch').toggleClass('hidden visible');
    });

    $('.material-download').on('click', function () {
        console.log('click');
        $target = $(this);
        $.ajax({
            'method': 'POST',
            'data': {
                'post_id': $target.data('post-id')
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
            },
            'url': uchebochka_vars.rest_url + uchebochka_vars.rest_route + '/download_counter_increment',
            'success': function (data) {
                if (data === false) {
                    return;
                }
                $counter = $('#download-counter');
                $count = parseInt($counter.text());
                $count++;
                $counter.text($count);
            }
        })
    })
});

document.addEventListener('DOMContentLoaded', function () {
    // Инициализация всех областей загрузки файлов
    const fileUploadAreas = document.querySelectorAll('.file-upload-area');

    fileUploadAreas.forEach(area => {
        const fileInput = area.querySelector('.file-input-hidden');
        const fileNamesContainer = area.querySelector('.file-names');

        // Обработчик клика по области
        area.addEventListener('click', function (e) {
            if (e.target !== fileInput) {
                fileInput.click();
            }
        });

        // Обработчик изменения файлового инпута
        fileInput.addEventListener('change', function () {
            updateFileNames(this.files, fileNamesContainer);
        });

        // Обработчики для drag & drop
        area.addEventListener('dragover', function (e) {
            e.preventDefault();
            area.classList.add('dragover');
        });

        area.addEventListener('dragleave', function () {
            area.classList.remove('dragover');
        });

        area.addEventListener('drop', function (e) {
            e.preventDefault();
            area.classList.remove('dragover');

            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                updateFileNames(e.dataTransfer.files, fileNamesContainer);
            }
        });
    });

    // Функция для обновления отображаемых имен файлов
    function updateFileNames(files, container) {
        container.innerHTML = '';

        if (files.length === 0) return;

        const fileNames = Array.from(files).map(file => {
            const fileName = document.createElement('span');
            fileName.className = 'file-name';
            fileName.textContent = file.name;
            return fileName;
        });

        fileNames.forEach(fileName => {
            container.appendChild(fileName);
            container.appendChild(document.createTextNode(', '));
        });

        // Удаляем последнюю запятую
        if (container.lastChild) {
            container.removeChild(container.lastChild);
        }
    }
});
document.addEventListener('DOMContentLoaded', function () {
    const priceScale = document.getElementById('priceScale');
    const sliderCircle = document.getElementById('sliderCircle');
    const downloadsInput = document.getElementById('downloads');
    const priceInput = document.getElementById('priceInput');
    const priceVal = document.querySelector('.price-val');
    const tooltip = new bootstrap.Tooltip(document.querySelector('[data-bs-toggle="tooltip"]'));
    let isDragging = false;

    // Функция для расчета и обновления дохода
    function updateIncome() {
        const price = parseFloat(priceInput.value) || 0;
        const downloads = parseInt(downloadsInput.value) || 0;

        // Формула: цена * скачивания в день * 30 дней / 2
        const income = (price * downloads * 30) / 2;
        priceVal.textContent = Math.round(income) + ' руб.';
    }

    // Функция для обновления позиции ползунка
    function updateSliderPosition(percentage) {
        percentage = Math.max(0, Math.min(100, percentage));
        sliderCircle.style.left = percentage + '%';

        // Обновляем значение скачиваний (от 1 до 100)
        const downloadsValue = Math.round(1 + (percentage / 100) * 99);
        downloadsInput.value = downloadsValue;

        updateIncome();
    }

    // Обработчики для перетаскивания ползунка
    sliderCircle.addEventListener('mousedown', function (e) {
        isDragging = true;
        e.preventDefault();
    });

    priceScale.addEventListener('mousedown', function (e) {
        const rect = priceScale.getBoundingClientRect();
        const percentage = ((e.clientX - rect.left) / rect.width) * 100;
        updateSliderPosition(percentage);
        isDragging = true;
    });

    document.addEventListener('mousemove', function (e) {
        if (!isDragging) return;

        const rect = priceScale.getBoundingClientRect();
        const percentage = ((e.clientX - rect.left) / rect.width) * 100;
        updateSliderPosition(percentage);
    });

    document.addEventListener('mouseup', function () {
        isDragging = false;
    });

    // Обработчики для ручного ввода значений
    downloadsInput.addEventListener('input', function () {
        const value = parseInt(this.value) || 1;
        const boundedValue = Math.max(1, Math.min(100, value));
        this.value = boundedValue;

        const percentage = ((boundedValue - 1) / 99) * 100;
        sliderCircle.style.left = percentage + '%';

        updateIncome();
    });

    priceInput.addEventListener('input', updateIncome);

    // Инициализация
    updateIncome();
});

// Синхронизация полей цены и ползунка
const minPriceInput = document.getElementById('min-price');
const maxPriceInput = document.getElementById('max-price');
const priceRange = document.getElementById('price-range');

// Получение значений из атрибутов данных
const minPrice = parseInt(minPriceInput.getAttribute('data-min'));
const maxPrice = parseInt(minPriceInput.getAttribute('data-max'));

// Обновление максимальной цены при изменении ползунка
priceRange.addEventListener('input', function () {
    maxPriceInput.value = this.value;
    updateSliderBackground();
});

// Обновление ползунка при изменении максимальной цены
maxPriceInput.addEventListener('input', function () {
    if (this.value > maxPrice) this.value = maxPrice;
    if (this.value < minPrice) this.value = minPrice;
    if (parseInt(this.value) < parseInt(minPriceInput.value)) {
        minPriceInput.value = this.value;
    }
    priceRange.value = this.value;
    updateSliderBackground();
});

// Проверка минимальной цены
minPriceInput.addEventListener('input', function () {
    if (this.value > maxPrice) this.value = maxPrice;
    if (this.value < minPrice) this.value = minPrice;
    if (parseInt(this.value) > parseInt(maxPriceInput.value)) {
        maxPriceInput.value = this.value;
        priceRange.value = this.value;
    }
    updateSliderBackground();
});

// Функция для обновления фона ползунка
function updateSliderBackground() {
    const minValue = parseInt(minPriceInput.value);
    const maxValue = parseInt(maxPriceInput.value);
    const percentage = (maxValue / maxPrice) * 100;
    priceRange.style.setProperty('--background-size', `${percentage}%`);
}

// Инициализация фона ползунка
updateSliderBackground();


document.addEventListener('DOMContentLoaded', function () {
    const sectionsWrapper = document.getElementById('sectionsWrapper');
    const sliderThumb = document.getElementById('sliderThumb');
    const trackWidth = sectionsWrapper.scrollWidth - sectionsWrapper.clientWidth;
    let isDragging = false;

    // Функция для обновления позиции ползунка
    function updateSliderPosition() {
        const scrollPercentage = sectionsWrapper.scrollLeft / trackWidth;
        const thumbPosition = scrollPercentage * (sectionsWrapper.clientWidth - sliderThumb.offsetWidth);
        sliderThumb.style.left = `${thumbPosition}px`;
    }

    // Функция для обновления позиции прокрутки
    function updateScrollPosition() {
        const thumbPosition = parseInt(sliderThumb.style.left) || 0;
        const maxThumbPosition = sectionsWrapper.clientWidth - sliderThumb.offsetWidth;
        const scrollPercentage = thumbPosition / maxThumbPosition;
        sectionsWrapper.scrollLeft = scrollPercentage * trackWidth;
    }

    // Обработчик прокрутки контейнера
    sectionsWrapper.addEventListener('scroll', updateSliderPosition);

    // Обработчики для перетаскивания ползунка
    sliderThumb.addEventListener('mousedown', function (e) {
        isDragging = true;
        sliderThumb.style.transition = 'none';
        e.preventDefault();
    });

    document.addEventListener('mousemove', function (e) {
        if (!isDragging) return;

        const trackRect = sectionsWrapper.getBoundingClientRect();
        const thumbWidth = sliderThumb.offsetWidth;
        let newLeft = e.clientX - trackRect.left - thumbWidth / 2;

        // Ограничение движения в пределах трека
        newLeft = Math.max(0, Math.min(newLeft, trackRect.width - thumbWidth));

        sliderThumb.style.left = `${newLeft}px`;
        updateScrollPosition();
    });

    document.addEventListener('mouseup', function () {
        if (isDragging) {
            isDragging = false;
            sliderThumb.style.transition = 'left 0.2s ease';
        }
    });

    // Аналогичные обработчики для сенсорных устройств
    sliderThumb.addEventListener('touchstart', function (e) {
        isDragging = true;
        sliderThumb.style.transition = 'none';
        e.preventDefault();
    });

    document.addEventListener('touchmove', function (e) {
        if (!isDragging) return;

        const trackRect = sectionsWrapper.getBoundingClientRect();
        const thumbWidth = sliderThumb.offsetWidth;
        let newLeft = e.touches[0].clientX - trackRect.left - thumbWidth / 2;

        // Ограничение движения в пределах трека
        newLeft = Math.max(0, Math.min(newLeft, trackRect.width - thumbWidth));

        sliderThumb.style.left = `${newLeft}px`;
        updateScrollPosition();
    });

    document.addEventListener('touchend', function () {
        if (isDragging) {
            isDragging = false;
            sliderThumb.style.transition = 'left 0.2s ease';
        }
    });

    // Инициализация позиции ползунка
    updateSliderPosition();

    // Обновление при изменении размера окна
    window.addEventListener('resize', function () {
        // Пересчитываем ширину трека после изменения размера
        setTimeout(updateSliderPosition, 100);
    });
});

// Кастомная карусель
let currentIndex = 0;
const track = document.getElementById('productsTrack');
const slides = document.querySelectorAll('.product-slide');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

// Количество видимых слайдов
function getVisibleSlides() {
    if (window.innerWidth < 576) return 1;
    if (window.innerWidth < 992) return 2;
    return 3;
}

// Обновление позиции карусели
function updateCarousel() {
    const visibleSlides = getVisibleSlides();
    const slideWidth = 100 / visibleSlides;
    track.style.transform = `translateX(-${currentIndex * slideWidth}%)`;

    // Обновляем активные карточки
    document.querySelectorAll('.product-card.active').forEach(card => {
        card.classList.remove('active');
    });

    // Центральная карточка становится активной
    const activeIndex = currentIndex + Math.floor(visibleSlides / 2);
    if (slides[activeIndex]) {
        slides[activeIndex].querySelector('.product-card').classList.add('active');
    }

    // Обновляем состояние кнопок
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= slides.length - visibleSlides;
}

// Следующий слайд
nextBtn.addEventListener('click', () => {
    const visibleSlides = getVisibleSlides();
    if (currentIndex < slides.length - visibleSlides) {
        currentIndex++;
        updateCarousel();
    }
});

// Предыдущий слайд
prevBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
    }
});

// Адаптивность при изменении размера окна
window.addEventListener('resize', updateCarousel);

// Функциональность для кнопки избранного
document.querySelectorAll('.favorite-btn').forEach(button => {
    button.addEventListener('click', function () {
        this.classList.toggle('active');
        const icon = this.querySelector('i');
        if (this.classList.contains('active')) {
            icon.classList.remove('bi-star');
            icon.classList.add('bi-star-fill');
        } else {
            icon.classList.remove('bi-star-fill');
            icon.classList.add('bi-star');
        }
    });
});

// Инициализация при загрузке
document.addEventListener('DOMContentLoaded', updateCarousel);


