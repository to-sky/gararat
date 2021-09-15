<div class="promotion__item shadow-sm" data-mh="promotion">
    <a href="{{ $product->path() }}" class="promotion__item__link"
       style="background-image: url('{{ $product->getFirstMediaUrl('main_image', 'medium') }}')">
    </a>

    <p>
        <a href="{{ $product->path() }}" class="btn btn-link promotion__item__name">{{ $product->trans('name') }}</a>
    </p>

    @if ($product->producer_id)
        <p class="promotion__item__producer-id ltr">{{ $product->producer_id }}</p>
    @endif

    <p class="promotion__item__price">{!! $product->displayPrice() !!}</p>
</div>
