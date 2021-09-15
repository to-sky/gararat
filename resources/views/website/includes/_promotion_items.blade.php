<div id="productsContainer">
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4">
                @include('website.includes._product_promotion_item', compact('product'))
            </div>
        @empty
            @include('website.includes._search-empty-result')
        @endforelse
    </div>
</div>

<div class="pagination__wrapper">
    {{ $products->appends(request()->only(['equipment', 'parts']))->links() }}
</div>
