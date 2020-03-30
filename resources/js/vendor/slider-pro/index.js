import 'slider-pro';
import 'slider-pro/dist/css/slider-pro.min.css';

export default (function () {
    // Homepage slider
    $('#homeSlider').sliderPro({
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

    // Slider for product single page
    $('#productSlider').sliderPro({
        fade: true,
        arrows: true,
        buttons: false,
        fullScreen: true,
        shuffle: false,
        imageScaleMode: 'contain',
        thumbnailArrows: true,
        autoplay: false,
        loop: false,
        aspectRatio: 1.6
    });

    // Slider for news single page
    $('#newsSlider').sliderPro({
        height: '400px',
        width: '100%',
        autoplayDelay: 5000,
        responsive: true,
        centerImage: true,
        loop: false
    });
}())