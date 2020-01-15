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
        height = 0,
        posX = 0,
        posY = 0,
        figure = $('#figureConstructorWrapperTarget').data('figure');
    // Edit click
    $(document).on('click', '#editNodePositionConstructor', function(e) {
        e.preventDefault();
        node = $(this).parent().data('id');
        color = $(this).parent().data('color');
        width = $(this).parent().parent().find('input[name="size_x"]').val();
        height = $(this).parent().parent().find('input[name="size_y"]').val();
        alert('Start editing node #' + node);
    });
    // Save click
    $(document).on('click', '#saveNodePositionConstructor', function(e) {
        e.preventDefault();
        $('.c-preloader').fadeIn(150);
        node = $(this).parent().data('id');
        width = $(this).parent().parent().find('input[name="size_x"]').val();
        height = $(this).parent().parent().find('input[name="size_y"]').val();
        posX = $(this).parent().parent().find('span[data-target="pos_x"]').text();
        posY = $(this).parent().parent().find('span[data-target="pos_y"]').text();
        axios.post('/api/v1.0/constructor/init/build/save', {
            id: node,
            fig_id: figure,
            pos_x: posX,
            pos_y: posY,
            size_x: width,
            size_y: height
        }).then(function (response) {
            // console.log(response);
            $('div#refreshWrapper').load(location.href + ' #refreshWrapper');
            alert('Node #' + node + 'saved!');
        }).catch(function (error) {
            // console.log(error);
        });
        $('.c-preloader').fadeOut(150);
    });
    // Remove click
    $(document).on('click', '#removeNodePositionConstructor', function(e) {
        e.preventDefault();
        $('.c-preloader').fadeIn(150);
        node = $(this).parent().data('id');
        axios.post('/api/v1.0/constructor/init/build/clear', {
            id: node,
            fig_id: figure
        }).then(function (response) {
            // console.log(response);
            $('div#refreshWrapper').load(location.href + ' #refreshWrapper');
            alert('Node #' + node + 'cleared!');
        }).catch(function (error) {
            // console.log(error);
        });
        $('.c-preloader').fadeOut(150);
    });
    // Image click
    $(document).on('click', '#figureConstructorWrapperTarget .figure img', function(e) {
        e.preventDefault();
        if(node !== null) {
            $('#targetConstructorNode_' + node).remove();
            // console.log('Initialized node=' + node + '!');
            let parentOffset = $(this).parent().offset();
            //or $(this).offset(); if you really just want the current element's offset
            let relX = e.pageX - parentOffset.left;
            let relY = e.pageY - parentOffset.top;
            // console.log('posX=' + relX + '; posY=' + relY);
            $(this).parent().append('<div id="targetConstructorNode_' + node + '" style="position: absolute; top: ' + (relY - (height / 2))+ 'px; left: ' + (relX - (width / 2)) + 'px; border: 1px solid ' + color + '; z-index: 9999; width: ' + width + 'px; height: ' + height + 'px;"></div>');
            $('#pos_x_' + node).text(relX);
            $('#pos_y_' + node).text(relY);
        }
    });
})(jQuery);
