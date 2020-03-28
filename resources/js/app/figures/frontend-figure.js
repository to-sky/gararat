function scrollToAnchor(aid, stock) {
    var aTag = $('#' + aid);
    if(stock == 1) {
        $(aTag).addClass('hovered');
        $(aTag).find('.collapsible-row-activator').addClass('colps').html('Collapse <i class="fas fa-angle-up"></i>');
        $('#' + $(aTag).find('.collapsible-row-activator').data('target')).slideDown(150);
    }
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}

(function($) {
    // Collapsible rows
    $(document).on('click', '.collapsible-row-activator', function(e) {
        e.preventDefault();
        let lang = $('select#lang').val(),
            toOrder = 'to order',
            collapse = 'Collapse';
        if(lang == 'ar') {
            toOrder = 'الطلب ';
            collapse = 'إغلاق ';
        }
        $('.drawing__nodes table tr').removeClass('hovered');
        let getTarget = $(this).data('target');
        if($('#' + getTarget).is(':visible')) {
            $(this).removeClass('colps').html(toOrder);
            $('#' + getTarget).slideUp(150);
        } else {
            $(this).parent().parent().addClass('hovered');
            $(this).addClass('colps').html(collapse + ' <i class="fas fa-angle-up"></i>');
            $('#' + getTarget).slideDown(150);
        }
    });
    // Figure scroll to anchor
    $(document).on('click', '.item-block', function(e) {
        e.preventDefault();
        scrollToAnchor($(this).data('target'), $(this).data('stock'));
    });
})(jQuery);
