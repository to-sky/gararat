(function($) {
    if($('.slider__wrapper').length !== 0) {
        $('#my-slider').sliderPro({
            width: '100%',
            arrows: true,
            buttons: false,
            autoplayDelay: 7000,
            autoHeight: true
        });
    }
})(jQuery);
