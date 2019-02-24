@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <div class="product">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="shadow product__images" id="blueimp" style="padding: 15px;">
                        <div class="row">
                            <div class="@if(count($images) > 0) col-9 @else col-12 @endif mip" style="padding-left: 15px;">
                                <div class="featured-image">
                                    <a href="{{ asset($featuredImage->mid_path) }}" title="{{ $pageTitle }}">
                                        <img src="{{ asset($featuredImage->mid_path) }}" alt="{{ $pageTitle }} Featured" class="image">
                                    </a>
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
                        <form action="#" method="post">
                            @csrf
                            <input type="hidden" name="nid" value="{{ $product->nid }}">
                            <input type="hidden" name="userKey">
                            <div class="product__purchase-top">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="product__purchase-price">
                                            @if($product->special_price !== NULL && $product->special_price != 0)
                                                <p><span class="old">${{ number_format($product->price, 0, '.', ' ') }}</span><span class="current">${{ number_format($product->special_price, 0, '.', ' ') }}</span></p>
                                            @else
                                                <p><span class="current">${{ number_format($product->price, 0, '.', ' ') }}</span></p>
                                            @endif
                                        </div>
                                        <!-- /.product__purchase-price -->
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="d-flex justify-content-around product__qty">
                                            <a href="#" id="subQTY"><i class="fas fa-minus"></i></a>
                                            <input type="number" name="qty" id="qty" value="1" min="1" style="max-width: 40px;">
                                            <a href="#" id="addQTY"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <!-- /.product__qty -->
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <button class="btn btn-add-to-cart" type="submit">Add to cart</button>
                                        <!-- /.btn btn-add-to-cart -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.product__purchase-top -->
                            <div class="product__purchase-bottom">
                                @if($product->in_stock == 0)
                                    <p class="in-stock out-stock"><i class="fas fa-times"></i> <span>Not in stock</span></p>
                                @else
                                    <p class="in-stock"><i class="fas fa-check"></i> <span>In stock</span></p>
                                @endif
                            </div>
                            <!-- /.product__purchase-bottom -->
                            <div class="product__short-description">
                                {!! $product->nmf_short_en !!}
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
                            <h4>Technical Specification</h4>
                            {!! $product->nmf_body_en !!}
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
