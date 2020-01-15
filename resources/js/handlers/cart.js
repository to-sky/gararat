function updateCart() {
    axios.get('/api/cart/' + localStorage.getItem('userKey'))
        .then(function(res) {
            console.log(res.data);
            let qty = res.data['qty'],
                total = res.data['total'];
            $('#cartItems').text(qty);
            $('#cartPrice').text(total);
            $('#totalPriceCheckout').text(total);
        })
        .catch(function(err) {
            console.log(err);
        });
}

function addToCart(key, id, qty) {
    axios.post('/api/cart/actions/add/item', {
        userKey: key,
        id: id,
        qty: qty
    })
        .then(function (response) {
            console.log(response);
            updateCart();
            $('.cart-success').fadeIn(250);
            setTimeout(function() {
                $('.cart-success').fadeOut(250);
            }, 2000);
        })
        .catch(function (error) {
            console.log(error);
        });
}
(function($) {
    updateCart();
    // Add to cart
    $(document).on('submit', '#addToCartHandler', function(e) {
        e.preventDefault();
        let userKey = $(this).find('input[name="userKey"]').val(),
            id = $(this).find('input[name="id"]').val(),
            qty = $(this).find('input[name="qty"]').val();
        addToCart(userKey, id, qty);
    });

    if($('#cartTableRenderer').length !== 0) {
        axios.get('/api/cart/' + localStorage.getItem('userKey') + '/table')
            .then(function(res) {
                // console.log(res.data);
                $('#cartTableRenderer tbody').html(res.data['return']);
            })
            .catch(function(err) {
                // console.log(err);
            });
    }

    if($('#cartProceedTableRenderer').length !== 0) {
        axios.get('/api/cart/' + localStorage.getItem('userKey') + '/table-proceed')
            .then(function(res) {
                console.log(res.data);
                $('#cartProceedTableRenderer tbody').html(res.data['return']);
            })
            .catch(function(err) {
                console.log(err);
            });
    }
})(jQuery);
