<div class="parts">
    <div class="row">
        @forelse($parts as $part)
            <div class="col-6 col-md-6 col-sm-4 d-flex flex-column flex-md-row justify-content-between parts__item">
                <div class="parts__item__image-content">
                    <div class="parts__item__image-container mb-2">
                        <a href="{{ $part->path() }}" class="parts__item__image-link">
                            <img src="{{ $part->getFirstMediaUrl('main_image', 'medium') }}" class="parts__item__image">
                        </a>
                    </div>

                    <div class="px-md-3">
                        <p>
                            <a href="{{ $part->path() }}" class="btn btn-link parts__item__name">{{ $part->trans('name') }}</a>
                        </p>

                        <p class="parts__item__producer-id ltr">{{ $part->producer_id }}</p>
                    </div>
                </div>

                <div>
                    <p class="parts__item__price">{!! $part->displayPrice() !!}</p>

                    <div class="d-flex flex-md-column justify-content-between">
                        <div class="d-flex my-md-4 justify-content-center">
                            @component('website.includes._product_qty_input', ['product' => $part]) @endcomponent
                        </div>

                        @include('website.includes._btn_add_to_cart', ['product' => $part, 'icon' => true, 'class' => 'w-0'])
                    </div>
                </div>
            </div>
            @empty
                @include('website.includes._search-empty-result')
        @endforelse
    </div>
</div>

<div class="pagination__wrapper">
    {{ $parts->appends(request()->only(['catalogs', 'equipmentGroups', 'inStock', 'price']))->links() }}
</div>
