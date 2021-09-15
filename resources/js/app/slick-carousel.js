import 'slick-carousel';

// Slider for promotion and best selling products
export default (function () {
    $('.slick-slider').slick({
        slidesToShow: 4,
        dots: true,
        slidesToScroll: 1,
        rtl: $('body').hasClass('rtl'),
        autoplay: true,
        autoplaySpeed: 7000,
        arrows: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 1440,
                settings: {
                    slidesToShow: 3,
                }
            }
        ]
    });
}())
