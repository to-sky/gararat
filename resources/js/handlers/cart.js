function updateCart() {
    axios.get('/api/cart/' + localStorage.getItem('userKey'))
        .then(function(res) {
            console.log(res.data);
            let qty = res.data['qty'],
                total = res.data['total'];
            $('#cartItems').text(qty);
            $('#cartPrice').text(total);
        })
        .catch(function(err) {
            console.log(err);
        })
}

function addToCart(key, nid, qty) {
    axios.post('/api/cart/actions/add/item', {
        userKey: key,
        nid: nid,
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
            nid = $(this).find('input[name="nid"]').val(),
            qty = $(this).find('input[name="qty"]').val();
        addToCart(userKey, nid, qty);
    });
})(jQuery);
