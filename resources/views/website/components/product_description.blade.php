<div class="product">
    <div class="product__purchase shadow border border-light-sm">
        <form action="#" method="post" id="addToCartHandler">
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">
            {{--<input type="hidden" name="userKey"> --}}

            <div class="product__purchase-top">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="product__purchase-price">
                            <p class="product-price">{!! $product->displaySitePrice() !!}</p>
                        </div>
                    </div>

                    <div class="col-4 col-md-4">
                        @include('website.components.product_qty_input')
                    </div>

                    <div class="col-8 col-md-3">
                        <button class="btn btn-outline-danger" type="button">{{ __('Add to cart') }}</button>
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
        </form>
    </div>
</div>