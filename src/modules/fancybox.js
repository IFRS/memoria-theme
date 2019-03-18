require('@fancyapps/fancybox');

$(function() {
    $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif']").attr('data-fancybox', 'gallery').fancybox();
    $("a[rel='gallery']").each(function() {
        var caption = $(this).parent().next('.gallery-caption').text();
        if (caption) {
            $(this).attr('data-caption', $.trim(caption));
        }
    });
});
