const contentImage = document.querySelectorAll('.content__image__box');

contentImage.forEach(item => {
    lightGallery(item, {
        selector: '.content__image__item',
        thumbnail: true,
    });
});

const gallery = document.querySelectorAll('.gallery__list');

gallery.forEach(item => {
    lightGallery(item, {
        selector: '.gallery__item__link',
        thumbnail: true,
    });
});