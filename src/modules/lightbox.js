import SimpleLightbox from "simplelightbox";

document.addEventListener('DOMContentLoaded', function() {
    let galleries = document.querySelectorAll('.wp-block-gallery');
    galleries.forEach(function(gallery) {
        let lightbox = new SimpleLightbox(gallery.querySelectorAll('a'), {
            captionsData: 'alt',
        });
    });

    let images = document.querySelectorAll('a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"],a[href$=".svg"]');
    images.forEach(function(image) {
        if (!image.closest('.wp-block-gallery')) {
            let lightbox = new SimpleLightbox(image, {
                captionsData: 'alt',
            });
        }
    });
});
