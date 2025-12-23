import { get_read_time } from './modules/article-time-read.js'
import { ym_ecommerce_init, ym_make_order, ym_clear_cart } from './modules/ym-ecommerce.js';
const $ = window.jQuery;
$(function () {

    $('input[type="tel"]').mask("+7 (999) 999-99-99");

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
    $('.cart-actions__form').on('submit',function(e){
        e.preventDefault();
        const phone = $(this).find('input[type="tel"]');
        const phoneVal = phone.val().replace(/\D/g, '');
        if (!/^(7|8)\d{10}$/.test(phoneVal)) {
            $('#warning').find('.modal-body').text('Введите корректный номер телефона');
            $('#warning').modal('show');
            phone.focus();
            return;
        }
        ym_make_order();
        $(this).off('submit');
        this.submit();
    })

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


})

