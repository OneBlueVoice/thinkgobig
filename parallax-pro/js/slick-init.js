jQuery(document).ready(function($) {
    $('.slick-slider').slick({
        accessibility: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav',
        responsive: [
            {
                breakpoint: 611,
                settings: {
                    adaptiveHeight: true,
                }
            },
        ]
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slick-slider',
        dots: true,
        centerMode: false,
        focusOnSelect: true
    });
});
