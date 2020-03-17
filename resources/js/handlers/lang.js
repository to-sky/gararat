(function($) {
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