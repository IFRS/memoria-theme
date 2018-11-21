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
