import { get_read_time } from './modules/article-time-read.js'
import { ym_ecommerce_init, ym_make_order, ym_clear_cart } from './modules/ym-ecommerce.js';
const $ = window.jQuery;
$(function () {

    $('input[type="tel"]').mask('+000000000000000', {
        placeholder: '+______________'
    });


    ym_ecommerce_init();
    const time_awerage_line = $('#timeread');
    const text_content = $('.article-body');
    if (time_awerage_line && text_content) {
        time_awerage_line.text(get_read_time(text_content));
    }

    const top = $('.top');
    const header = top.find('header');
    var offsetTop = header.offset().top;

    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= offsetTop) {
            top.addClass('fixed');
            if (!$('#header-placeholder-style').length) {
                $('head').append('<style id="header-placeholder-style"> body { --header-height: ' + header.outerHeight() + 'px; } </style>');
            }
        } else {
            top.removeClass('fixed');
            $('#header-placeholder-style').remove();
        }
    });

    $('.cart-checkout-btn').on('click', function () {
        ym_make_order();
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
    $('.cart-actions__form').on('submit', function (e) {
        e.preventDefault();

        const phoneInput = $(this).find('input[type="tel"]');
        const rawVal = phoneInput.val();
        const phoneVal = rawVal.replace(/[^\d+]/g, '');

        // E.164: + и 8–15 цифр
        if (!/^\+\d{8,15}$/.test(phoneVal)) {
            $('#warning')
                .find('.modal-body')
                .text('Введите корректный номер телефона в международном формате, например +79161234567');
            $('#warning').modal('show');
            phoneInput.focus();
            return;
        }

        // если нужно — сохраняем очищенный номер
        phoneInput.val(phoneVal);

        ym_make_order();
        $(this).off('submit');
        this.submit();
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

                    ym_clear_cart();

                    $('.balance-amount').text('0.00 ₽');
                    $('.cart-actions__form').fadeRemove();
                    $('.cart-clear-btn').fadeRemove();
                },
                error: function () {
                    alert('Ошибка при очистке корзины.');
                }
            });
        }
    });

    $('.section-materials__authentication-form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const username = form.find('input[name="log"]').val().trim();
        const password = form.find('input[name="pwd"]').val();
        const redirectTo = form.find('input[name="redirect_to"]').val();
        const submitBtn = form.find('button[name="wp-submit"]');
        const nonce = form.find('input[name="uchebka_login_nonce"]').val();

        // Remove previous error messages
        form.find('.error-message').remove();

        // Basic client-side validation
        if (!username) {
            showFormError(form, 'Пожалуйста, введите логин');
            return;
        }

        if (!password) {
            showFormError(form, 'Пожалуйста, введите пароль');
            return;
        }

        if (password.length < 6) {
            showFormError(form, 'Пароль должен содержать минимум 6 символов');
            return;
        }

        // Disable submit button and show loading state
        submitBtn.prop('disabled', true);
        submitBtn.text('Загрузка...');

        // Send AJAX request
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'login',
                username: username,
                password: password,
                redirect_to: redirectTo,
                nonce: nonce
            },
            dataType: 'json',
            // beforeSend: function (xhr) {
            //     xhr.setRequestHeader('X-WP-Nonce', uchebochka_vars.nonce);
            // },
            success: function (response) {
                if (response.success) {
                    window.location.href = response.data.redirect;
                } else {
                    showFormError(form, response.data.message);
                    submitBtn.prop('disabled', false);
                    submitBtn.text('Войти');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                const errorMessage = jqXHR.responseJSON?.data?.message || 'Ошибка при попытке входа. Попробуйте позже.';
                showFormError(form, errorMessage);
                submitBtn.prop('disabled', false);
                submitBtn.text('Войти');
            }
        });
    });

    // Show error message in form
    function showFormError(form, message) {
        const errorDiv = $('<div class="error-message" style="color: #d32f2f; margin-top: 10px; padding: 10px; background-color: #ffebee; border-radius: 4px;"></div>');
        errorDiv.text(message);
        form.append(errorDiv);
        // Auto-remove error after 5 seconds
        setTimeout(function () {
            errorDiv.fadeOut(300, function () {
                $(this).remove();
            });
        }, 5000);
    }

})

