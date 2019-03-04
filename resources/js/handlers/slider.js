(function($) {
    if($('.slider__wrapper').length !== 0) {
        $('#my-slider').sliderPro({
            width: '100%',
            arrows: true,
            buttons: false,
            autoplayDelay: 7000,
            autoHeight: true,
            responsive: true,
            centerImage: true,
            breakpoints: {
                1000: {
                    arrows: false,
                    buttons: false,
                    keyboard: false,
                    width: '100%',
                    centerImage: true,
                    autoSlideSize: true,
                    forceSize: 'fullWidth'
                }
            }
        });
    }
})(jQuery);
