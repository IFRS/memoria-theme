$(function() {
    $('.navbar-menu').each(function(_i, menu) {
        $(menu).find('.has-dropdown').each(function(_k, dropdown) {
            if ($(dropdown).children('.navbar-dropdown').length > 0) {
                $(dropdown)
                    .children('a')
                    .on('click', function(e) {
                        e.preventDefault();
                        $(menu).find('.has-dropdown').not($(this).parent()).removeClass('is-active');
                        $(this).parent().toggleClass('is-active');
                    })
                    .on('blur', function() {
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
