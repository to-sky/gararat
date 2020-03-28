// Delete media
$('[data-image-action="delete"]').click(function (e) {
    e.preventDefault();

    let imageContainer = $(this).closest('[data-image-container]');

    $.ajax({
        url: $(this).attr('href'),
        data: {
            method: 'DELETE'
        },
        success: function ()
        {
            imageContainer.animate({
                opacity: 0
            }, 500, function() {
                $(this).remove();
            })
        }
    });
});
