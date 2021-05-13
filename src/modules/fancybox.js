require('@fancyapps/fancybox');

$(function() {
    $.fancybox.defaults.buttons = [
        //"zoom",
        //"share",
        "slideShow",
        //"fullScreen",
        "download",
        "thumbs",
        "close"
    ];
    $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],a[href$='.webp']").each(function() {
        if ($(this).children('img').length === 1) {
            $(this).attr('data-fancybox', 'gallery');

            let caption = $(this).siblings('figcaption').first().text();

            if (caption) {
                $(this).attr('data-caption', $.trim(caption));
            }
        }
    });
});
