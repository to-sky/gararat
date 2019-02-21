@foreach($products as $key => $product)
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 product__wrapper">
        <div class="text-center shadow-sm product__inner">
            <a href="{{ route('singleNodePage', $product->nid) }}">
                <img src="{{ asset($product->thumb_path) }}" alt="{{ $product->n_name_en }}" class="image">
            </a>
        </div>
        <!-- /.text-center product__inner -->
        <div class="text-center product__name">
            <a href="{{ route('singleNodePage', $product->nid) }}">{{ $product->n_name_en }}</a>
        </div>
        <!-- /.text-center shadow-sm product__name -->
    </div>
    <!-- /.col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 product__wrapper -->
@endforeach
