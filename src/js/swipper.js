// const { default: Swiper } = require("swiper");

let swiper = new Swiper(".hero", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    loop : true,
    autoplay: {
        delay: 5000,
        pauseOnMouseEnter : true,
        disableOnInteraction : false,
    },
});

let caroulsel = new Swiper('.content__image__box', {
    loop : true,
    pagination: {
        el: ".swiper-pagination",
    },
    autoplay: {
        delay: 4000,
        pauseOnMouseEnter : true,
        disableOnInteraction : false,
    },
})

let testimonials = new Swiper('.testimonial__list', {
    loop : true,
    navigation: {
        nextEl: ".testimonial__nav__item--next",
        prevEl: ".testimonial__nav__item--prev",
      },
    autoplay: {
        delay: 4000,
        pauseOnMouseEnter : true,
        disableOnInteraction : false,
    },
})