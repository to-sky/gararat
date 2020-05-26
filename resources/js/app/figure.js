(function($) {
    if($('#figureConstructorWrapperTarget').length !== 0) {
        require('./figures/secured-constructor');
    }

    $('.header__mobile-activator a').on('click', function(e) {
        e.preventDefault();
        let headerMenu = $('.header__main .header__main-menu');

        if(headerMenu.is(':visible')) {
            headerMenu.slideUp(250);
        } else {
            headerMenu.slideDown(250);
        }
    });
})(jQuery);

require('./figures/frontend-figure');