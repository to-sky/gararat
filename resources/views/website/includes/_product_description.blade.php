<div class="product">
    <div class="product__purchase shadow border border-light-sm">
        <div class="product__purchase-top">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="product__purchase-price">
                        <p class="product-price">{!! $product->displayPrice() !!}</p>
                    </div>
                </div>

                <div class="col-4 col-md-4">
                    @include('website.includes._product_qty_input')
                </div>

                <div class="col-8 col-md-3">
                    @include('website.includes._btn_add_to_cart')
                </div>
            </div>
        </div>

        <div class="product__purchase-bottom">
            @if($product->in_stock)
                <p class="in-stock"><i class="fas fa-check"></i>
                    <span>{{ __('In stock') }}</span>
                </p>
            @else
                <p class="in-stock out-stock"><i class="fas fa-times"></i>
                    <span>{{ __('Not in stock') }}</span>
                </p>
            @endif
        </div>

        @if($description = $product->trans('description'))
            <p class="product__short-description">{{ $description }}</p>
        @endif
    </div>
</div>