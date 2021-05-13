require('@fancyapps/fancybox');

$(function() {
    $.fancybox.defaults.buttons = [
        "zoom",
        //"share",
        "slideShow",
        //"fullScreen",
        "download",
        //"thumbs",
        "close"
    ];
    $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],a[href$='.webp']").each(function() {
        if ($(this).children('img').length === 1) {
            $(this).attr('data-fancybox', 'gallery');

            wp_gallery = $(this).parents('.wp-block-gallery').first();
            if (wp_gallery.length === 1) {
                if (!wp_gallery.attr('id')) {
                    wp_gallery.attr('id', 'gallery-' + Math.floor(Math.random() * 100));
                }
                $(this).attr('data-fancybox', wp_gallery.attr('id'));
            }

            let caption = $(this).siblings('figcaption').first().text();

            if (caption) {
                $(this).attr('data-caption', $.trim(caption));
            }
        }
    });
});
