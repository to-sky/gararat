<button class="btn btn-sm-icon btn-outline-danger {{ $btnClass ?? '' }}"
        data-action="add-to-cart"
        data-product-type="{{ $product->getProductType() }}"
        data-id="{{ $product->id }}"
        type="button">
        @if(isset($icon)) <i class="fas fa-shopping-cart"></i> @else {{ __('Add to cart') }} @endif
</button>