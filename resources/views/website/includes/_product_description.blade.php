<div class="product__purchase shadow border-light-sm">
    <div class="product__purchase-top">
        <div class="row">
            <div class="col-8 col-sm-5 col-md-5 mb-3 mb-sm-0">
                <div class="product__purchase-price">
                    <p class="product-price">{!! $product->displayPrice() !!}</p>
                </div>
            </div>

            <div class="col-4 col-sm-4 col-md-4">
                @include('website.includes._product_qty_input')
            </div>

            <div class="col-12 col-sm-3 col-md-3">
                @include('website.includes._btn_add_to_cart', ['btnClass' => $btnClass ?? ''])
            </div>
        </div>
    </div>

    <div class="product__purchase-bottom">
        <p class="in-stock">
            @if($product->in_stock)
                <i class="fas fa-check"></i>
                <span>{{ __('In stock') }}</span>
            @else
                <span>{{ __('Available for order') }}</span>
            @endif
        </p>
    </div>

    @if($description = $product->trans('description'))
        <p class="product__short-description">{{ $description }}</p>
    @endif
</div>
