<div class="product-carousel shadow">
    <div class="row">
        <div class="col-12">
            <div id="productSlider" class="slider-pro">
                <div class="sp-slides">
                    <div class="sp-slide">
                        <img class="sp-image" src="{{ $product->getFirstMediaUrl('main_image', 'thumb') }}"
                             data-src="{{ $product->getFirstMediaUrl('main_image', 'large') }}"
                             data-small="{{ $product->getFirstMediaUrl('main_image', 'thumb') }}"
                             data-medium="{{ $product->getFirstMediaUrl('main_image', 'large') }}"
                             data-large="{{ $product->getFirstMediaUrl('main_image', 'large') }}"
                             data-retina="{{ $product->getFirstMediaUrl('main_image', 'large') }}"/>
                    </div>

                    @foreach ($product->getMedia('additional_images') as $image)
                        <div class="sp-slide">
                            <img class="sp-image" src="{{ $image->getUrl('thumb') }}"
                                 data-src="{{ $image->getUrl('large') }}"
                                 data-small="{{ $image->getUrl('thumb') }}"
                                 data-medium="{{ $image->getUrl('large') }}"
                                 data-large="{{ $image->getUrl('large') }}"
                                 data-retina="{{ $image->getUrl('large') }}"/>
                        </div>
                    @endforeach
                </div>

                <div class="sp-thumbnails">
                    <img class="sp-thumbnail" src="{{ $product->getFirstMediaUrl('main_image', 'thumb') }}">

                    @foreach ($product->getMedia('additional_images') as $image)
                        <img class="sp-thumbnail" src="{{ $image->getUrl('thumb') }}" alt="{{ $image->name }}"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>