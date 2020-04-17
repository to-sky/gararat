<div class="cart-table table-responsive shadow">
    <table class="table">
        <thead class="border-0">
        <tr>
            <th>{{ __('Image') }}</th>
            <th>{{ __('Product Name') }}</th>
            <th class="pl-5">{{ __('Quantity') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Total price') }}</th>
            <th>{{ __('Delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach (Cart::content() as $rowId => $item)
            @php($model = $item->model)

            <tr>
                <td>
                    <img src="{{ $model->getFirstMediaUrl('main_image', 'thumb') }}" height="35">
                </td>
                <td>
                    <a href="{{ route(Str::plural($model->getTable()).'.show', $model) }}">
                        {{ $item->name }}
                    </a>
                </td>
                <td>
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
                </td>
                <td>{!! displayPrice($model->price, $model, $model->is_special, $model->special_price) !!}</td>
                <td>{!! displayPrice(CartService::itemTotal($rowId), $model) !!}</td>
                <td>
                    <button class="btn btn-sm-icon btn-outline-danger"
                            data-row-id="{{ $rowId }}"
                            data-action="remove-from-cart">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" class="text-muted text-right text-md">{{ __('Total') }}: {{ CartService::total() }}</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between my-5">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        {{ __('Go to Home') }}
    </a>

    <a href="{{ route('checkout') }}" class="btn btn-outline-danger">
        {{ __('Checkout') }}
    </a>
</div>