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

    $('.sub-qty').on('click', function(e) {
        e.preventDefault();
        let getCurrentQty = $(this).parent().find('input').val();
        if(getCurrentQty > 1) {
            getCurrentQty = parseInt(getCurrentQty) - 1;
            $(this).parent().find('input').val(getCurrentQty);
        }
    });
    $('.add-qty').on('click', function(e) {
        e.preventDefault();
        let getCurrentQty = $(this).parent().find('input').val();
        getCurrentQty = parseInt(getCurrentQty) + 1;
        $(this).parent().find('input').val(getCurrentQty);
    });
})(jQuery);
