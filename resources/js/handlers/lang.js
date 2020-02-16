(function($) {
    // Show languages on hover
    // $('.lang__header').hover(
    //     function() {
    //         $(this).next('div').show().removeClass('fadeOut').addClass('fadeIn')
    //     },
    //     function () {
    //         let timeout = function() {
    //             setTimeout(function() {
    //                 if ($('.lang__header').is(':hover') || $('.lang__body').is(':hover')) {
    //                     timeout();
    //                 } else {
    //                     $('.lang__body').removeClass('fadeIn').addClass('fadeOut');
    //                 }
    //             }, 600);
    //         };
    //
    //         timeout();
    // });

    // Show languages on click
    let langBody = $('.lang__body');
    $('#changeLangHandler').click(function() {
        if ($(langBody).css('display') == 'block') {
            $(langBody).hide();
        } else {
            $(langBody).show();
        }
    });

    $('.lang__body_switcher-item').click(function() {
        let radio = $(this).find('input[type="radio"]');
        $(radio).prop('checked', true);

        window.location.href = "/lang-switch/" + $(radio).val();
    });
})(jQuery);