<div class="row">
    <div class="col-md-8 col-xl-9">
        <div class="px-3 bg-white shadow-sm">
            <div class="cart__content">
                @foreach (Cart::content() as $rowId => $item)
                    @php($model = $item->model)

                    <div class="row cart__product">
                        <div class="col-4 col-md-3 col-xl-2">
                            <img src="{{ $model->getFirstMediaUrl('main_image', 'thumb') }}" class="img-thumbnail">
                        </div>

                        <div class="col-8 col-md-9 col-xl-10">
                            <a href="{{ route(Str::plural($model->getTable()).'.show', $model) }}" class="cart__product-link">
                                {{ $item->name }}
                            </a>

                            <p class="cart__product-producer-id ltr">{{ $model->producer_id }}</p>

                            <p class="cart__product-price">{!! $model->displayPrice() !!}</p>

                            <div class="d-flex flex-fill justify-content-between pt-3 pt-md-0">
                                <button class="btn cart__product__remove-btn"
                                        data-row-id="{{ $rowId }}"
                                        data-action="remove-from-cart">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <div class="product-counter">
                                    <button type="button" class="sub-qty"
                                            data-id="{{ $model->id }}"
                                            data-action="update-cart"
                                            data-row-id="{{ $rowId }}"
                                            @if($item->qty == 1) disabled @endif>
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input type="number" name="qty" id="qty_{{ $model->id }}" value="{{ $item->qty }}" min="1"
                                           readonly>

                                    <button type="button" class="add-qty"
                                            data-id="{{ $model->id }}"
                                            data-action="update-cart"
                                            data-row-id="{{ $rowId }}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4 col-xl-3">
        <div class="cart__total">
            <div class="p-3 border-bottom">
                <a href="{{ route('checkout') }}" class="btn btn-danger w-100">
                    {{ __('Checkout') }}
                </a>
            </div>

            <div class="p-3">
                <div class="row py-2">
                    <div class="col-auto mr-auto">
                        <h5 class="cart__total-label">{{ __('Items') }}:</h5>
                    </div>
                    <div class="col-auto">
                        <p class="cart__total-text">{{ Cart::count() }}</p>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-auto mr-auto">
                        <h5 class="cart__total-label">{{ __('Total') }}:</h5>
                    </div>
                    <div class="col-auto">
                        <p class="cart__total-text">{!! CartService::displayTotal() !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>