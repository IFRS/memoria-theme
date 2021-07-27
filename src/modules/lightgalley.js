import lightGallery from 'lightgallery';

document.addEventListener('DOMContentLoaded', function() {
    let galleries = document.querySelectorAll('.wp-block-gallery');
    galleries.forEach(function(gallery) {
        lightGallery(gallery, {
            selector: '.blocks-gallery-item a',
        });
    });

    let images = document.querySelectorAll('a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"],a[href$=".webp"],a[href$=".svg"]');
    images.forEach(function(imageLink) {
        if (!imageLink.closest('.wp-block-gallery') && !imageLink.closest('.tainacan-media-component')) {
            lightGallery(image, {
                selector: 'this',
            });
        }
    });
});
