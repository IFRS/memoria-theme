$(function() {
    $('.navbar-menu').each(function(i, menu) {
        $(menu).find('.menu-item').each(function(j, menu_item) {
            $(menu_item).addClass('navbar-item');
        });

        $(menu).find('.menu-item-has-children').each(function(k, dropdown) {
            if ($(dropdown).children('.sub-menu').length > 0) {
                $(dropdown).addClass('menu-item has-dropdown');
                $(dropdown).children('.sub-menu').addClass('navbar-dropdown');
                $(dropdown)
                    .children('a')
                    .addClass('navbar-link')
                    .on('click', function(e) {
                        e.preventDefault();
                        $(menu).find('.has-dropdown').not($(this).parent()).removeClass('is-active');
                        $(this).parent().toggleClass('is-active');
                    })
                    .on('blur', function(e) {
                        setTimeout(() => {
                            $(this).parent().removeClass('is-active');
                        }, 100);
                    });
            }
        });
    });

    $(".navbar-burger").on('click', function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");
    });
});
