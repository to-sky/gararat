<div class="row">
    <div class="col-12 border-bottom shadow-sm">
        <h4 class="py-2 mb-0 text-primary-light">{{ __('Your order') }}</h4>
    </div>

    {{-- Cart content --}}
    <div class="col-md-12 border-bottom py-2" style="max-height: 324px; overflow: auto;">
        @foreach(Cart::content() as $item)
            @php($model = $item->model)

            <div class="row mb-3">
                <div class="col-4">
                    <img src="{{ $model->getFirstMediaUrl('main_image', 'thumb') }}" class="img-thumbnail p-0">
                </div>

                <div class="col-6">
                    <small class="d-block">
                        <a href="{{ route(Str::plural($model->getTable()).'.show', $model) }}" class="btn btn-link p-0 pb-1">
                            {{ $item->name }}
                        </a>
                    </small>

                    <small class="d-block pb-2">
                        {{ $model->producer_id }}
                    </small>

                    <small class="d-block pb-2">
                        {!! CartService::displayItemTotal($item->rowId) !!}
                    </small>
                </div>

                <div class="col-2 pt-2">
                    <span class="border p-1 rounded float-right">{{ $item->qty }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Total block --}}
    <div class="col-12">
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

    {{-- Checkout button --}}
    <div class="col-md-12 py-4 border-top text-center">
        <button class="btn btn-danger w-100" type="submit">{{ __('Checkout') }}</button>
    </div>
</div>
