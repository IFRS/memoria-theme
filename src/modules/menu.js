$(function() {
    $('.menu-collapse .sub-menu').addClass('collapse');

    $('.menu-collapse .menu-item-has-children .sub-menu').before(`
        <button class="btn btn-sm" aria-expanded="false">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#424241" stroke-width="3" stroke-linecap="square" stroke-linejoin="arcs">
                <path d="M6 9l6 6 6-6"/>
            </svg>
            <span class="sr-only">Expandir submenus</span>
        </button>
    `);

    $('.menu-collapse > .menu-item-has-children > button').on('click', function(e) {
        /* $('.menu-collapse .collapse').collapse('hide'); */
        $(this).nextAll('.collapse').collapse('toggle');
        e.preventDefault();
    });

    $('.menu-collapse .collapse').on('show.bs.collapse', function(e) {
        var collapse = $(e.target);
        collapse.prev('button').attr('aria-expanded', 'true');
        collapse.prev('button').children('svg').first().html('<path d="M18 15l-6-6-6 6"/>');
        collapse.prev('button').children('span.sr-only').first().text('Ocultar submenus');
    });

    $('.menu-collapse .collapse').on('hide.bs.collapse', function(e) {
        var collapse = $(e.target);
        collapse.prev('button').attr('aria-expanded', 'false');
        collapse.prev('button').children('svg').first().html('<path d="M6 9l6 6 6-6"/>');
        collapse.prev('button').children('span.sr-only').first().text('Expandir submenus');
    });

    // Abre todos os collapse anteriores e posteriores ao item atual.
    $('.current-menu-item, .current-menu-parent').parents('.collapse').collapse('show');
    $('.current-menu-item, .current-menu-parent').children('.collapse').collapse('show');

    // Controla a exibição do menu em viewports pequenos.
    if ($(window).width() < 992) {
        $(".coluna-collapse").collapse('hide');
    }
    $(window).resize(function() {
        if ($(window).width() < 992) {
            $(".coluna-collapse").collapse('hide');
        } else {
            $(".coluna-collapse").collapse('show');
        }
    });

    $('.btn-menu-toggle').on('click', function(e) {
        $(".coluna-collapse").collapse('toggle');
        e.preventDefault();
    });
});
