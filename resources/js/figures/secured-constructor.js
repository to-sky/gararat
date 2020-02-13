let node = null,
    nodeId = null,
    color = null,
    width = 0,
    height = 0,
    posX = 0,
    posY = 0,
    position,
    figure = $('#figureConstructorWrapperTarget').data('figure');

let preloader = $('#c-preloader');

// Edit click
$(document).on('click', '.editNodePositionConstructor', function(e) {
    e.preventDefault();

    node = $(this).closest('td');
    position = node.data('position');
    nodeId = node.data('id');
    color = node.data('color');

    width = node.siblings('td').find('input[name="size_x"]').val();
    height = node.siblings('td').find('input[name="size_y"]').val();

    alert('Start editing node #' + nodeId + ' on position ' + position);
});

// Save click
$(document).on('click', '.saveNodePositionConstructor', function(e) {
    e.preventDefault();

    node = $(this).closest('td');
    nodeId = node.data('id');

    posX = node.siblings('td').find('span[data-target="pos_x"]').text();
    posY = node.siblings('td').find('span[data-target="pos_y"]').text();

    width = node.siblings('td').find('input[name="size_x"]').val();
    height = node.siblings('td').find('input[name="size_y"]').val();

    axios.post('/api/v1.0/constructor/init/build/save', {
        id: nodeId,
        fig_id: figure,
        pos_x: posX,
        pos_y: posY,
        size_x: width,
        size_y: height
    }).then(function () {
        $('div#refreshWrapper').load(location.href + ' #refreshWrapper');

        alert('Node #' + nodeId + ' saved!');
    });
});

// Remove click
$(document).on('click', '.removeNodePositionConstructor', function(e) {
    e.preventDefault();

    node = $(this).closest('td');
    nodeId = node.data('id');

    axios.post('/api/v1.0/constructor/init/build/clear', {
        id: nodeId,
        fig_id: figure
    }).then(function () {
        $('div#refreshWrapper').load(location.href + ' #refreshWrapper');

        alert('Node #' + nodeId + ' cleared!');
    });
});

// Image click
$(document).on('click', '#figureConstructorWrapperTarget .figure img', function(e) {
    e.preventDefault();

    nodeId = node.data('id');

    if(nodeId !== null) {
        $('#targetConstructorNode_' + nodeId).remove();
        let parentOffset = $(this).parent().offset();

        let relX = e.pageX - parentOffset.left;
        let relY = e.pageY - parentOffset.top;

        $(this).parent().append(
            '<div id="targetConstructorNode_' + nodeId + '" style="position: absolute; ' +
            'top: ' + (relY - (height / 2))+ 'px; ' +
            'left: ' + (relX - (width / 2)) + 'px; ' +
            'border: 1px solid ' + color + '; ' +
            'z-index: 700; ' +
            'width: ' + width + 'px; ' +
            'height: ' + height + 'px;"></div>'
        );

        $('#pos_x_' + nodeId).text(relX);
        $('#pos_y_' + nodeId).text(relY);
    }
});
