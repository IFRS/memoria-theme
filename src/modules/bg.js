$(function() {
    var classes = ['bg1', 'bg2', 'bg3', 'bg4'];
    var bg = classes[Math.floor(Math.random() * classes.length)];
    $('.main-wrapper').addClass(bg);
});
