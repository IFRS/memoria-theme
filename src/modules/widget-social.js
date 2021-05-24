$(function() {
    $('.widget-social').each(function() {
        let titulo = $(this).children('h3').first();

        if (titulo.length > 0) {
            let link = $(this).children('a').first();
            link.addClass('has-tooltip-arrow');
            link.attr('data-tooltip', $.trim(titulo.text()));
        }
    });
});
