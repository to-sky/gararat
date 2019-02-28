(function($) {
    /**
    $(document).on('click', '#figureConstructorWrapperTarget .figure img', function(e) {
        e.preventDefault();
        let parentOffset = $(this).parent().offset();
        //or $(this).offset(); if you really just want the current element's offset
        let relX = e.pageX - parentOffset.left;
        let relY = e.pageY - parentOffset.top;
        $(this).parent().append('<div style="position: absolute; top: ' + (relY - (22 / 2))+ 'px; left: ' + (relX - (30 / 2)) + 'px; border: 1px solid red; z-index: 9999; width: 28px; height: 20px;"></div>');
        console.log(relX + ' ' + relY);
    });
     */
    var node = null,
        color = null,
        width = 0,
        height = 0;
    // Edit click
    $(document).on('click', '#editNodePositionConstructor', function(e) {
        e.preventDefault();
        node = $(this).parent().data('nid');
        color = $(this).parent().data('color');
        width = $(this).parent().parent().find('input[name="size_x"]').val();
        height = $(this).parent().parent().find('input[name="size_y"]').val();
    });
    // Save click
    $(document).on('click', '#saveNodePositionConstructor', function(e) {
        e.preventDefault();
        node = $(this).parent().data('nid');
    });
    // Remove click
    $(document).on('click', '#removeNodePositionConstructor', function(e) {
        e.preventDefault();
        node = $(this).parent().data('nid');
    });
    // Image click
    $(document).on('click', '#figureConstructorWrapperTarget .figure img', function(e) {
        e.preventDefault();
        if(node !== null) {
            console.log(width + '|' + height);
        }
    });
})(jQuery);
