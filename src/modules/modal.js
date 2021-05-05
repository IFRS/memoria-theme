$(function() {
    $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],a[href$='.webp']").each(function() {
        $(this).attr('data-toggle', 'modal');
        $(this).attr('data-target', '#modal-img');
    });

    $('#modal-img').on('show.bs.modal', function (event) {
        let link = $(event.relatedTarget);
        let src = link.attr('href');
        let img = link.children('img').first();
        let caption = link.siblings('figcaption').first();

        if (img) {
            $(this).find('.modal-body').html(img.clone().removeClass().addClass('img-fluid'));
        } else {
            $(this).find('.modal-body').html($('<img src="' + src + '" class="img-fluid" alt="">'));
        }

        if (caption) {
            $(this).find('.modal-caption').text(caption.text());
        }

        $(this).modal('handleUpdate');
    });
});
