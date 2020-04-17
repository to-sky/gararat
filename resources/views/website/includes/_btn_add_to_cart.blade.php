<button class="btn btn-sm-icon btn-outline-danger {{ $class ?? '' }}"
        data-action="add-to-cart"
        data-product-type="{{ strtolower(class_basename($product)) }}"
        data-id="{{ $product->id }}"
        type="button">
        @if(isset($icon)) <i class="fas fa-shopping-cart"></i> @else {{ __('Add to cart') }} @endif
</button>