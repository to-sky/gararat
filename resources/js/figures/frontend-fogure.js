(function($) {
    // Collapsible rows
    $(document).on('click', '.collapsible-row-activator', function(e) {
        e.preventDefault();
        $('.drawing__nodes table tr').removeClass('hovered');
        let getTarget = $(this).data('target');
        if($('#' + getTarget).is(':visible')) {
            $(this).removeClass('colps').html('to order');
            $('#' + getTarget).slideUp(150);
        } else {
            $(this).parent().parent().addClass('hovered');
            $(this).addClass('colps').html('Collapse <i class="fas fa-angle-up"></i>');
            $('#' + getTarget).slideDown(150);
        }
    });
})(jQuery);
