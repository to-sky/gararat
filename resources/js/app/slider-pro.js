import 'slider-pro';

// Slider for product single page
export default (function () {
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
        aspectRatio: 1.6,
        rightToLeft: $('body').hasClass('rtl')
    });
}())
