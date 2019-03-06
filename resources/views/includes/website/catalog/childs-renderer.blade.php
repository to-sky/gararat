@foreach($catalogChilds as $child)
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 product__wrapper">
        <div class="text-center shadow-sm product__inner">
            <a href="{{ route('catalogPage', $child->cid) }}">
                @if($child->cat_image !== null)
                    <img src="{{ asset($child->cat_image) }}" alt="{{ $child->cat_name_en }}" class="image">
                @else
                    <img src="{{ asset('assets/blank.png') }}" alt="{{ $child->cat_name_en }}" class="image">
                @endif
            </a>
        </div>
        <!-- /.text-center product__inner -->
        <div class="text-center product__name">
            <a href="{{ route('catalogPage', $child->cid) }}">{{ $child->cat_name_en }}</a>
        </div>
        <!-- /.text-center shadow-sm product__name -->
    </div>
    <!-- /.col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 product__wrapper -->
@endforeach
