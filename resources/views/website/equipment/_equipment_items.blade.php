@foreach($equipment as $item)
    <div class="col-md-6">
        <div class="equipment-card shadow-sm">

            <div class="row">
                <div class="col-6">
                    <a href="{{ route('equipment.show', $item) }}">
                        <div class="equipment-card__image"
                             style="background-image: url('{{ asset($item->getFirstMediaUrl('main_image', 'medium')) }}')">
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <div class="equipment-card__description">
                        <a href="{{ route('equipment.show', $item) }}" class="equipment-card__title">
                            {{ $item->trans('name') }}
                        </a>

                        @if($item->main_specifications)
                            <div class="equipment-card__specifications">
                                @foreach($item->main_specifications['data'] as $main_specification)
                                    <p class="equipment-card__specifications__item">{{ translateArrayItem($main_specification, 'key') }}  {{ translateArrayItem($main_specification, 'value') }}</p>
                                @endforeach
                            </div>
                        @endif

                        <p class="product-price py-2">{!! $item->displayPrice() !!}</p>

                        <p class="in-stock text-md">
                            @if($item->in_stock)
                                <i class="fas fa-check"></i>
                                <span>{{ __('In stock') }}</span>
                            @else
                                <span>{{ __('Available for order') }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
    <script>
        $('.equipment-card').matchHeight({
            byRow: false
        });
    </script>
@endpush