import * as $ from 'jquery';
import 'slider-pro';
import 'slider-pro/dist/css/slider-pro.min.css';

export default (function () {
    if($('.slider__wrapper').length !== 0) {
        $('#my-slider').sliderPro({
            fade: true,
            fadeDuration: 1000,
            width: '100%',
            arrows: true,
            buttons: false,
            autoplayDelay: 10000,
            autoHeight: true,
            responsive: true,
            centerImage: true,
            touchSwipe: false,
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
}())