@foreach($equipment as $item)
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 product__wrapper">
        <div class="text-center shadow-sm product__inner">
            <a href="{{ route('equipment.show', $item) }}" style="margin: 0 auto;">
                <img src="{{ asset($item->getFirstMediaUrl('main_image', 'medium')) }}"
                     class="image" alt="{{ $item->name }}">
            </a>
        </div>

        <div class="text-center product__name">
            <a href="{{ route('equipment.show', $item) }}">
                {{ $item->trans('name') }}
            </a>
        </div>
    </div>
@endforeach