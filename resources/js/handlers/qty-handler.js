(function($) {
    let currentQty = $('#qty').val();
    $('#subQTY').on('click', function(e) {
        e.preventDefault();
        if(currentQty > 1) {
            currentQty = parseInt(currentQty) - 1;
            $('#qty').val(currentQty);
        }
    });
    $('#addQTY').on('click', function(e) {
        e.preventDefault();
        currentQty = parseInt(currentQty) + 1;
        $('#qty').val(currentQty);
    });
})(jQuery);
