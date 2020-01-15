
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
require('./handlers/qty-handler');
require('./handlers/user-identity');
require('./handlers/cart');
require('./handlers/slider');
require('./handlers/lang');

(function($) {
    if($('#figureConstructorWrapperTarget').length !== 0) {
        require('./figures/secured-constructor');
    }

    $('.header__mobile-activator a').on('click', function(e) {
        e.preventDefault();
        if($('.header__main .header__main-menu').is(':visible')) {
            $('.header__main .header__main-menu').slideUp(250);
        } else {
            $('.header__main .header__main-menu').slideDown(250);
        }
    });

    $(document).on("cut copy", function(e) {
        e.preventDefault();
    });

    // $(document).on("contextmenu",function(){
    //     return false;
    // });

    $('#contactFormPageForm button[type="submit"]').on('click', function() {
        $('#checkCode').val('g29853qg-(*&H@#O(*&FH0908hj2dc89hncole9r8whcd');
    });
})(jQuery);
require('./figures/frontend-fogure');
