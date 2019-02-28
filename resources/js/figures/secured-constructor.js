(function($) {
    $(document).on('click', '#figureConstructorWrapperTarget .figure img', function(e) {
        e.preventDefault();
        let parentOffset = $(this).parent().offset();
        //or $(this).offset(); if you really just want the current element's offset
        let relX = e.pageX - parentOffset.left;
        let relY = e.pageY - parentOffset.top;
        $(this).parent().append('<div style="position: absolute; top: ' + (relY - (22 / 2))+ 'px; left: ' + (relX - (30 / 2)) + 'px; border: 1px solid red; z-index: 9999; width: 28px; height: 20px;"></div>');
        console.log(relX + ' ' + relY);
    });
})(jQuery);
