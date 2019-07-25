import Swiper from 'swiper';

$(function() {
    var timelineSwiper = new Swiper ('.swiper-container', {
        direction: 'vertical',
        loop: false,
        speed: 1600,
        mousewheel: false,
        allowTouchMove: false,
        effect: "coverflow",

        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
            renderBullet: function (index, className) {
                var year = document.querySelectorAll('.swiper-slide')[index].getAttribute('data-year');
                return '<li class="' + className + '">' + year + '</li>';
            }
        }
    });

    $('.swiper-container').first().height($(window).outerHeight() - $('.swiper-pagination').first().outerHeight() - 35);
    $(window).resize(function() {
        $('.swiper-container').first().height($(window).outerHeight() - $('.swiper-pagination').first().outerHeight() - 35);
    });
});
