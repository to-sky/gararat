(function($) {
    // Show languages on click
    let langBody = $('.lang__body');
    $('#changeLang').click(function() {
        langBody.toggle();
    });

    $('.lang__body_switcher-item').click(function() {
        let radio = $(this).find('input[type="radio"]');
        $(radio).prop('checked', true);

        window.location.href = "/language/" + $(radio).val();
    });
})(jQuery);