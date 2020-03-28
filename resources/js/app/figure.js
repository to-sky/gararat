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

    // $(document).on("cut copy", function(e) {
    //     e.preventDefault();
    // });

    // $(document).on("contextmenu",function(){
    //     return false;
    // });

    // $('#contactFormPageForm button[type="submit"]').on('click', function() {
    //     $('#checkCode').val('g29853qg-(*&H@#O(*&FH0908hj2dc89hncole9r8whcd');
    // });
})(jQuery);

require('./figures/frontend-figure');