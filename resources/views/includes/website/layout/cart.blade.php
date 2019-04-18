<div class="cart">
    <div class="cart__top">
        <div class="d-flex justify-content-between">
            <div class="cart__item-count">
                <i class="fas fa-shopping-cart"></i>
                @if(App::isLocale('en'))
                    <span id="cartItems">0</span> item(-s)
                @else
                    <span id="cartItems">0</span> البند
                @endif
            </div>
            <!-- /.cart__item-count -->
            <div class="cart__checkout">
                <a href="{{ route('cartPage') }}" class="shadow-sm btn btn-checkout">
                    @if(App::isLocale('en'))
                        Checkout
                    @else
                        الدفع
                    @endif
                </a>
                <!-- /.btn btn-checkout -->
            </div>
            <!-- /.cart__checkout -->
        </div>
        <!-- /.d-flex justify-content-between -->
    </div>
    <!-- /.cart__top -->
</div>
<!-- /.cart -->
