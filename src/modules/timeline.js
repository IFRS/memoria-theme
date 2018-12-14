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
            clickable: true,
            renderBullet: function (index, className) {
                var year = document.querySelectorAll('.swiper-slide')[index].getAttribute('data-year');
                return '<span class="' + className + '">' + year + '</span>';
            }
        }
    });
});
