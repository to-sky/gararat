(function($) {
    $('.lang__header').hover(
        function() {
            $(this).next('div').show().removeClass('fadeOut').addClass('fadeIn')
        },
        function () {
            let timeout = function() {
                setTimeout(function() {
                    if ($('.lang__header').is(':hover') || $('.lang__body').is(':hover')) {
                        timeout();
                    } else {
                        $('.lang__body').removeClass('fadeIn').addClass('fadeOut');
                    }
                }, 600);
            };

            timeout();
    });

    $('.lang__body_switcher-item').click(function() {
        let radio = $(this).find('input[type="radio"]');
        $(radio).prop('checked', true);

        window.location.href = "/lang-switch/" + $(radio).val();
    });
})(jQuery);