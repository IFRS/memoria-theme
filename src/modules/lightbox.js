require('lightbox2');

document.addEventListener('DOMContentLoaded', function() {
    let galleries = document.querySelectorAll('.wp-block-gallery');
    galleries.forEach(function(gallery) {
        gallery.querySelectorAll('a').forEach(function(imageLink) {
            imageLink.dataset.lightbox = 'gallery';
            imageLink.dataset.title = imageLink.querySelector('img').getAttribute('alt');
        })
    });

    let images = document.querySelectorAll('a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"],a[href$=".svg"]');
    images.forEach(function(imageLink) {
        if (!imageLink.closest('.wp-block-gallery') && !imageLink.closest('.tainacan-media-component')) {
            imageLink.dataset.lightbox = 'single';
            imageLink.dataset.title = imageLink.querySelector('img').getAttribute('alt');
        }
    });
});
