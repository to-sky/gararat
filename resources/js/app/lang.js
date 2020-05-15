(function($) {
    // Show languages on click
    let langBody = $('#langBody');
    $('#changeLang').click(function(e) {
        e.preventDefault();

        langBody.toggle();
    });

    $('.header__lang__item').click(function() {
        let radio = $(this).find('input[type="radio"]');
        $(radio).prop('checked', true);

        window.location.href = "/language/" + $(radio).val();
    });
})(jQuery);