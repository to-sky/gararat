<div class="row">
    @forelse($equipment as $item)
        <div class="col-md-6">
            <div class="equipment-card shadow-sm">

                <div class="row">
                    <div class="col-6">
                        <a href="{{ $item->path() }}">
                            <div class="equipment-card__image"
                                 style="background-image: url('{{ asset($item->getFirstMediaUrl('main_image', 'medium')) }}')">
                            </div>
                        </a>
                    </div>
                    <div class="col-6">
                        <div class="equipment-card__description">
                            <a href="{{ $item->path() }}" class="equipment-card__title">
                                {{ $item->trans('name') }}
                            </a>

                            @if($item->main_specifications)
                                <div class="equipment-card__specifications">
                                    @php
                                        $mainSpecifications = \App\Services\RequestService::filterArray($item->main_specifications['data'])
                                    @endphp

                                    @foreach($mainSpecifications as $mainSpecification)
                                        <p class="equipment-card__specifications__item">
                                            {{ translateArrayItem($mainSpecification, 'key') }}  {{ translateArrayItem($mainSpecification, 'value') }}
                                        </p>
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
        @empty
            @include('website.includes._search-empty-result')
        @endforelse
</div>

<div class="pagination__wrapper">
    @if ($equipment->count())
        {{ $equipment->appends(request()->only(['equipment_categories']))->links() }}
    @endif
</div>
