(function($) {
    let body = $('body');

    body.on('click', '.sub-qty', function(e) {
        let getCurrentQty = $(this).parent().find('input').val();
        if(getCurrentQty > 1) {
            getCurrentQty = parseInt(getCurrentQty) - 1;
            $(this).parent().find('input').val(getCurrentQty);
        }
    });

    body.on('click', '.add-qty', function(e) {
        let getCurrentQty = $(this).parent().find('input').val();
        getCurrentQty = parseInt(getCurrentQty) + 1;
        $(this).parent().find('input').val(getCurrentQty);
    });
})(jQuery);
