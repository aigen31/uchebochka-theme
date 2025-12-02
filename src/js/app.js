import { get_read_time } from './modules/article-time-read.js'
const $  = window.jQuery;
$(function(){

    const time_awerage_line = $('#timeread');
    const text_content = $('.article-body');
    if(time_awerage_line && text_content){
        time_awerage_line.text(get_read_time(text_content));
    }

    const header = $('header');
    var offsetTop = header.offset().top;

    $(window).on('scroll', function() {
      if ($(window).scrollTop() >= offsetTop) {
        header.addClass('fixed');
      } else {
        header.removeClass('fixed');
      }
    });
})
