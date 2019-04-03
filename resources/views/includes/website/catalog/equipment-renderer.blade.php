@foreach($products as $key => $product)
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 product__wrapper">
        <div class="text-center shadow-sm product__inner">
            <a href="{{ route('singleNodePage', $product->nid) }}" style="margin: 0 auto;">
                @if($product->has_photo === 0)
                    <img src="{{ asset('assets/logos/logo.jpg') }}" class="image" alt="{{ $product->n_name_en }}">
                @else
                    <img src="{{ asset($product->thumb_path) }}" class="image" alt="{{ $product->n_name_en }}">
                @endif
            </a>
        </div>
        <!-- /.text-center product__inner -->
        <div class="text-center product__name">
            @if(App::isLocale('en'))
                <a href="{{ route('singleNodePage', $product->nid) }}">{{ $product->n_name_en }}</a>
            @else
                <a href="{{ route('singleNodePage', $product->nid) }}">{{ $product->n_name_ar }}</a>
            @endif
        </div>
        <!-- /.text-center shadow-sm product__name -->
    </div>
    <!-- /.col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 product__wrapper -->
@endforeach
