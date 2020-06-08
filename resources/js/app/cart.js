let preloaderIcon = $('<i>', {class: 'fas fa-cog fa-spin text-danger'});

// Show preloader
function showPreloader() {
    let preloader = $('<div>', {class: 'preloader'}).append(preloaderIcon);

    $('#cartContainer').prepend(preloader);

    preloader.fadeIn();
}

// Hide preloader
function hidePreloader() {
    $('.preloader').fadeOut('normal', function () {
        $(this).remove();
    });
}

// Update cart content and qty in the header
function updateCartHtml(response, onlyQty = false) {
    $('#cartItems').text(response.data.qty);

    if (onlyQty) {
        return false;
    }

    $('#cartContent').html(response.data.html);
}

// Add product to cart
$(document).on('click', '[data-action="add-to-cart"]', function (e) {
    let id = $(this).data('id');
    let productType = $(this).data('product-type');
    let qty = $('#qty_' + id).val();

    let btnTarget = $(this);
    let buttonContent = btnTarget.html();
    btnTarget.prop('disabled', true).html(preloaderIcon);

    axios.post('/cart/store', {
        id: id,
        product_type: productType,
        qty: qty
    })
    .then(function(response) {
        $('.cart-success').fadeIn(250).delay(2000).fadeOut(250);

        updateCartHtml(response, true);

        btnTarget.html(buttonContent).prop('disabled', false);
    })
    .catch(function(error) {
        console.log('Error', error.message);
    });
});

// Update product qty
$(document).on('click', '[data-action="update-cart"]', function (e) {
    let id = $(this).data('id');
    let rowId = $(this).data('row-id');
    let qty = $('[data-row-qty=' + rowId + '_' + id + ']').val();

    if (qty < 1) return false;

    showPreloader();

    axios.patch('/cart/update', {
        rowId: rowId,
        qty: qty
    })
    .then(function(response) {
        updateCartHtml(response);
    })
    .catch(function(error) {
        console.log('Error', error.message);
    })
    .then(function () {
        hidePreloader();
    });
});

// Remove product from cart
$(document).on('click', '[data-action="remove-from-cart"]', function (e) {
    let rowId = $(this).data('row-id');
    let tableRow = $(this).closest('tr');

    showPreloader();

    axios.delete('/cart/remove', {
        data: {
            rowId: rowId
        }
    })
    .then(function(response) {
        updateCartHtml(response);

        tableRow.remove();
    })
    .catch(function(error) {
        console.log('Error', error.message);
    })
    .then(function () {
        hidePreloader();
    });
});