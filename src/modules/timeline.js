$(function() {
    $('.timeline a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        let old_pane = $(e.relatedTarget.attributes.href.value);
        let new_pane = $(e.target.attributes.href.value);
        $(new_pane).removeClass('fadeOutLeft fadeInRight').addClass('fadeInRight');
    })
});
