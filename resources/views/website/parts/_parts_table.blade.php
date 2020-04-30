<div class="parts shadow-sm">
    @foreach($parts as $part)
        <div class="row parts__item">
            <div class="col-sm-6 col-md-2">
                <p>
                    <a href="{{ route('parts.show', $part) }}">
                        <img src="{{ $part->getFirstMediaUrl('main_image', 'thumb') }}" class="img-responsive img-thumbnail">
                    </a>
                </p>
            </div>

            <div class="col-sm-6 col-md-10">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <a href="{{ route('parts.show', $part) }}" class="btn btn-link">{{ $part->trans('name') }}</a>

                        <p class="parts__item-producer">{{ $part->producer_id }}</p>
                    </div>

                    <div class="col-md-4">
                        <p>{!! $part->displayPrice() !!} </p>
                    </div>

                    <div class="col-sm-12 col-md-2">
                        @component('website.includes._product_qty_input', ['product' => $part]) @endcomponent
                    </div>

                    <div class="col-sm-12 col-md-2">
                        <p class="text-center">
                            @include('website.includes._btn_add_to_cart', ['product' => $part, 'icon' => true, 'class' => 'w-0'])

                            @auth
                                <a href="{{ route('admin.parts.edit', $part) }}" class="btn btn-sm-icon btn-outline-muted" target="_blank">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endauth
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="pagination__wrapper">
    {{ $parts->appends(request()->only(['catalogs', 'equipmentGroups', 'inStock', 'price']))->links() }}
</div>