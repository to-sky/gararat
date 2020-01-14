@extends('layouts.app')

@section('content')
    <div class="container">
        @if(App::isLocale('en'))
            <h1 class="page-title">{{ $pageTitle }}</h1>
        @else
            <h1 class="page-title text-right">{{ $pageTitle }}</h1>
        @endif
        <div class="product">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="shadow product__images" id="blueimp" style="padding: 15px;">
                        <div class="row">
                            <div class="@if(count($images) > 0) col-9 @else col-12 @endif mip" style="padding-left: 15px;">
                                <div class="featured-image">
                                    @if(isset($featuredImage) && $featuredImage !== null)
                                        <a href="{{ asset($featuredImage->mid_path) }}" title="{{ $pageTitle }}">
                                            <img src="{{ asset($featuredImage->mid_path) }}" alt="{{ $pageTitle }} Featured" class="image">
                                        </a>
                                    @else
                                        <a href="{{ asset('assets/blank.png') }}" title="{{ $pageTitle }}">
                                            <img src="{{ asset('assets/blank.png') }}" alt="{{ $pageTitle }} Featured" class="image">
                                        </a>
                                    @endif
                                </div>
                                <!-- /.featured-image -->
                            </div>
                            <!-- /.col-10 -->
                            @if(count($images) > 0)
                                <div class="col-3 additional-images mip" style="padding-right: 15px;">
                                    @foreach($images as $key => $image)
                                        <div class="additional-image">
                                            <a href="{{ asset($image->mid_path) }}" title="{{ $pageTitle }}">
                                                <img src="{{ asset($image->thumb_path) }}" alt="{{ $pageTitle . ' ' . $key }}" class="image">
                                            </a>
                                        </div>
                                        <!-- /.additional-image -->
                                    @endforeach
                                </div>
                            @endif
                            <!-- /.col-2  additional-images -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.product__images -->
                </div>
                <!-- /.col-12 col-lg-6 -->
                <div class="col-12 col-lg-6">
                    <div class="shadow product__purchase">
                        <form action="#" method="post" id="addToCartHandler">
                            @csrf
                            <input type="hidden" name="nid" value="{{ $product->nid }}">
                            <input type="hidden" name="userKey">
                            <div class="product__purchase-top">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="product__purchase-price">
                                            @if($product->special_price !== NULL && $product->special_price != 0)
                                                <p>
                                                    <span class="old">@if(!App::isLocale('en')) جنيه @endif{{ number_format($product->price, 2, '.', '') }} @if(App::isLocale('en')) LE @endif</span>
                                                    <br>
                                                    <span class="current">@if(!App::isLocale('en')) جنيه @endif{{ number_format($product->special_price, 2, '.', '') }} @if(App::isLocale('en')) LE @endif</span>
                                                </p>
                                            @else
                                                @if($product->price != 0)
                                                    <p>
                                                        <span class="current">@if(!App::isLocale('en')) جنيه @endif{{ number_format($product->price, 2, '.', '') }} @if(App::isLocale('en')) LE @endif</span>
                                                    </p>
                                                @else
                                                    <p>
                                                        <span class="current">
                                                            @if(App::isLocale('en'))
                                                                By Request
                                                            @else
                                                                حسب الطلب
                                                            @endif
                                                        </span>
                                                    </p>
                                                @endif
                                            @endif
                                        </div>
                                        <!-- /.product__purchase-price -->
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <div class="d-flex justify-content-around product__qty">
                                            <a href="#" id="subQTY"><i class="fas fa-minus"></i></a>
                                            <input type="number" name="qty" id="qty" value="1" min="1" style="max-width: 40px;">
                                            <a href="#" id="addQTY"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <!-- /.product__qty -->
                                    </div>
                                    <div class="col-8 col-md-4">
                                        <button class="btn btn-add-to-cart" type="submit">
                                            @if(App::isLocale('en'))
                                                Add to cart
                                            @else
                                                أضف إلى السلة
                                            @endif
                                        </button>
                                        <!-- /.btn btn-add-to-cart -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.product__purchase-top -->
                            <div class="product__purchase-bottom">
                                @if($product->in_stock == 0)
                                    <p class="in-stock out-stock"><i class="fas fa-times"></i>
                                        <span>
                                            @if(App::isLocale('en'))
                                                Not in stock
                                            @else
                                                ليس في المخزون
                                            @endif
                                        </span>
                                    </p>
                                @else
                                    <p class="in-stock"><i class="fas fa-check"></i>
                                        <span>
                                            @if(App::isLocale('en'))
                                                In stock
                                            @else
                                                في المخزن
                                            @endif
                                        </span>
                                    </p>
                                @endif
                            </div>
                            <!-- /.product__purchase-bottom -->
                            <div class="product__short-description">
                                @if(App::isLocale('en'))
                                    {!! $product->nmf_short_en !!}
                                @else
                                    {!! $product->nmf_short_ar !!}
                                @endif
                            </div>
                            <!-- /.product__short-description -->
                        </form>
                    </div>
                    <!-- /.product__purchase -->
                </div>
                <!-- /.col-12 col-lg-6 -->
            </div>
            <!-- /.row -->
            @if($product->nmf_body_en !== NULL)
                <div class="row">
                    <div class="col-12">
                        <div class="shadow product__description">
                            @if(App::isLocale('en'))
                                <h4>Technical Description</h4>
                                {!! $product->nmf_body_en !!}
                            @else
                                <h4 class="text-right rtl-separator">المواصفات الفنية</h4>
                                {!! $product->nmf_body_ar !!}
                            @endif
                        </div>
                        <!-- /.product__description -->
                    </div>
                    <!-- /.col-12 -->
                </div>
                <!-- /.row -->
            @endif
        </div>
        <!-- /.product -->
    </div>
    <!-- /.container -->
    <script src="{{ asset('blueimp/blueimp-gallery.min.js') }}"></script>
    <script>
        document.getElementById('blueimp').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
    </script>
@endsection
