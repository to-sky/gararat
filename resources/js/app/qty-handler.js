(function($) {
    // let currentQty = $('#qty').val();
    let body = $('body');

    // body.on('click', '#subQTY', function(e) {
    //     if(currentQty > 1) {
    //         currentQty = parseInt(currentQty) - 1;
    //         $('#qty').val(currentQty);
    //     }
    // });
    //
    // body.on('click', '#addQTY', function(e) {
    //     currentQty = parseInt(currentQty) + 1;
    //     $('#qty').val(currentQty);
    // });

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
