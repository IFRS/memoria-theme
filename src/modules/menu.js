$(function() {
    $('.menu-collapse .sub-menu').addClass('collapse');
    $('.menu-collapse .sub-menu').prev('a').addClass('collapsed');
    $('.menu-collapse .sub-menu').prev('a').attr('aria-expanded', 'false');
    $('.menu-collapse .sub-menu').prev('a').append('<span class="sr-only"> (Expandir submenus)</span>');

    $('.menu-collapse > .menu-item-has-children > a').on('click', function(e) {
        $('.menu-collapse .collapse').collapse('hide');
        $(this).nextAll('.collapse').collapse('toggle');
        e.preventDefault();
    });

    $('.menu-collapse .collapse').on('show.bs.collapse', function(e) {
        var collapse = $(e.target);
        collapse.prev('a').removeClass('collapsed');
        collapse.prev('a').attr('aria-expanded', 'true');
        collapse.prev('a').children('span.sr-only').first().text(' (Ocultar submenus)');
    });

    $('.menu-collapse .collapse').on('hide.bs.collapse', function(e) {
        var collapse = $(e.target);
        collapse.prev('a').addClass('collapsed');
        collapse.prev('a').attr('aria-expanded', 'false');
        collapse.prev('a').children('span.sr-only').first().text(' (Expandir submenus)');
    });

    // Abre todos os collapse até o item atual.
    $('.current-menu-item, .current-menu-parent').parents('.collapse').collapse('show');

    // Controla a exibição do menu em viewports pequenos.
    if ($(window).width() < 992) {
        $(".collapse").collapse('hide');
    }
    $(window).resize(function() {
        if ($(window).width() < 992) {
            $(".collapse").collapse('hide');
        } else {
            $(".collapse").collapse('show');
        }
    });
    $('.btn-menu-toggle').on('click', function(e) {
        $(".collapse").collapse('toggle');
        e.preventDefault();
    });
});
