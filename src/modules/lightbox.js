require('lightbox2');
import { v4 as uuidv4 } from 'uuid';

document.addEventListener('DOMContentLoaded', function() {
    let galleries = document.querySelectorAll('.wp-block-gallery');
    galleries.forEach(function(gallery) {
        let id = uuidv4();
        gallery.querySelectorAll('a').forEach(function(imageLink) {
            imageLink.dataset.lightbox = id;
            imageLink.dataset.title = imageLink.querySelector('img').getAttribute('alt');
        })
    });

    let images = document.querySelectorAll('a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"],a[href$=".gif"],a[href$=".svg"]');
    images.forEach(function(imageLink) {
        if (!imageLink.closest('.wp-block-gallery') && !imageLink.closest('.tainacan-media-component')) {
            imageLink.dataset.lightbox = uuidv4();
            imageLink.dataset.title = imageLink.querySelector('img').getAttribute('alt');
        }
    });
});
