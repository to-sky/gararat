<div class="row">
    <div class="col-12 border-bottom shadow-sm">
        <h4 class="py-2 mb-0 text-muted">{{ __('Your order') }}</h4>
    </div>

    {{-- Cart content --}}
    <div class="col-md-12 checkout__cart-content">
        @foreach(Cart::content() as $item)
            @if($product = $item->model)
                <div class="row mb-3">
                    <div class="col-4 col-sm-3 col-md-3 col-lg-4">
                        <img src="{{ $product->getFirstMediaUrl('main_image', 'thumb') }}" class="img-thumbnail p-0">
                    </div>

                    <div class="col-6 col-sm-7 col-md-7 col-lg-6">
                        <a href="{{ $product->path() }}" class="cart__product-link">
                            {{ $item->name }}
                        </a>

                        <p class="cart__product-producer-id ltr">{{ $product->producer_id }}</p>

                        <p class="cart__product-price">{!! CartService::displayItemTotal($item->rowId) !!}</p>
                    </div>

                    <div class="col-2">
                        <span class="border p-1 rounded float-right">{{ $item->qty }}</span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Total block --}}
    <div class="col-12 p-3 border-bottom">
        <div class="row mb-3">
            <div class="col-auto mr-auto">
                <h5 class="cart__total-label">{{ __('Items') }}:</h5>
            </div>
            <div class="col-auto">
                <p class="cart__total-text">{{ Cart::count() }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-auto mr-auto">
                <h5 class="cart__total-label">{{ __('Total') }}:</h5>
            </div>
            <div class="col-auto">
                <p class="cart__total-text">{!! CartService::displayTotal() !!}</p>
            </div>
        </div>
    </div>

    <div class="col-12 d-flex flex-column align-items-center">
        @if(env('GOOGLE_RECAPTCHA_KEY'))
            <div class="g-recaptcha pt-4 @error('g-recaptcha-response') is-invalid @enderror"
                 data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
            </div>

            @error('g-recaptcha-response')
                <div class="invalid-feedback d-block text-center pt-2">{{ $message }}</div>
            @enderror
        @endif
    </div>

    {{-- Checkout button --}}
    <div class="col-md-12 py-4 text-center">
        <button class="btn btn-danger w-100" type="submit">{{ __('Checkout') }}</button>
    </div>
</div>
