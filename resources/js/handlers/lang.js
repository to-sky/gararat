(function($) {
    $('#changeLangHandler select').on('change', function(e) {
        e.preventDefault();
        let lang = $(this).val();
        window.location.href = "/lang-switch/" + lang;
    });
})(jQuery);