<div class="row">
    <div class="col-md-9">
        <div class="px-3 bg-white shadow-sm">
            <div class="cart__content">
                @foreach (Cart::content() as $rowId => $item)
                    @php($model = $item->model)

                    <div class="row border-bottom py-3">
                        <div class="col-md-2">
                            <img src="{{ $model->getFirstMediaUrl('main_image', 'thumb') }}" class="img-thumbnail p-0">
                        </div>

                        <div class="col-md-4">
                            <p>
                                <a href="{{ route(Str::plural($model->getTable()).'.show', $model) }}">
                                    {{ $item->name }}
                                </a>
                            </p>

                            <p>
                                <small>{{ $model->producer_id }}</small>
                            </p>

                            <p>
                                {!! $model->displayPrice() !!}
                            </p>
                        </div>

                        <div class="col-md-2">
                            <p>{!! CartService::displayItemTotal($rowId) !!}</p>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-8">
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
                                <div class="col-md-4">
                                    <button class="btn btn-sm-icon btn-outline-danger"
                                            data-row-id="{{ $rowId }}"
                                            data-action="remove-from-cart">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="cart__total bg-white shadow-sm">
            <div class="p-3 border-bottom">
                <a href="{{ route('checkout') }}" class="btn btn-danger w-100">
                    {{ __('Checkout') }}
                </a>
            </div>

            <div class="p-3">
                <div class="row py-2">
                    <div class="col-auto mr-auto">
                        <h5 class="mb-0 text-black-50">{{ __('Items') }}:</h5>
                    </div>
                    <div class="col-auto">
                        <p class="mb-0 pt-2">{{ Cart::count() }}</p>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-auto mr-auto">
                        <h5 class="mb-0 text-black-50">{{ __('Total') }}:</h5>
                    </div>
                    <div class="col-auto">
                        <p class="mb-0 pt-2">{!! CartService::displayTotal() !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>