$(function() {
    var classes = ['bg1', 'bg2'];
    var bg = classes[Math.floor(Math.random() * classes.length)];
    $('.main-wrapper').addClass(bg);
});
