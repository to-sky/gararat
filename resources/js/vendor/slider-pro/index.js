import 'slider-pro';
import 'slider-pro/dist/css/slider-pro.min.css';

export default (function () {
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