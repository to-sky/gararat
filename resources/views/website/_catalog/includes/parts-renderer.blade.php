<div class="col-12">
    @if(!isset($hideFilters) || $hideFilters !== true)
        <div class="products__parts-filters">
            <div class="d-flex justify-content-between">
                <div class="sorting-listing-by">
                    @if(App::isLocale('en'))
                        <span>Sorting by:</span>
                    @endif
                    <a @if($target == 'price') class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'price', 'dest' => $neededTarget, 'per_page' => $perPage]) }}">
                        @if(App::isLocale('en'))
                            Price
                        @else
                            السعر
                        @endif
                        @if($neededTarget == 'ASC')
                            <i class="fas fa-sort-amount-down"></i>
                        @else
                            <i class="fas fa-sort-amount-up"></i>
                        @endif
                    </a>
                    @if(App::isLocale('en'))
                        <a @if($target == 'n_name_en') class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'n_name_en', 'dest' => $neededTarget, 'per_page' => $perPage]) }}">
                    @else
                        <a @if($target == 'n_name_ar') class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'n_name_ar', 'dest' => $neededTarget, 'per_page' => $perPage]) }}">
                    @endif
                        @if(App::isLocale('en'))
                            Name
                        @else
                            الاسم
                        @endif
                        @if($neededTarget == 'ASC')
                            <i class="fas fa-sort-alpha-down"></i>
                        @else
                            <i class="fas fa-sort-alpha-up"></i>
                        @endif
                    </a>
                    @if(!App::isLocale('en'))
                        <span> :العرض بواسطة</span>
                    @endif
                </div>
                <!-- /.sorting-listing-by -->
                <div class="show-by">
                    <a @if($perPage == 20) class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'price', 'dest' => $neededTarget, 'per_page' => 20]) }}">20</a>
                    <a @if($perPage == 50) class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'price', 'dest' => $neededTarget, 'per_page' => 50]) }}">50</a>
                    <a @if($perPage == 100) class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'price', 'dest' => $neededTarget, 'per_page' => 100]) }}">100</a>
                </div>
                <!-- /.show-by -->
            </div>
            <!-- /.d-flex justify-content-between -->
        </div>
        <!-- /.products__parts-filters -->
    @endif
    <div class="products__parts">
        @foreach($products as $product)
            <div class="products__part">
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="row">
                            <div class="col-4 col-lg-3">
                                <div class="products__part-image">
                                    @if($product->has_photo === 0)
                                        <a href="{{ route('singleNodePage', $product->id) }}"><img src="{{ asset('images/logo.jpg') }}" class="image" alt="{{ $product->n_name_en }}"></a>
                                    @else
                                        <a href="{{ route('singleNodePage', $product->id) }}"><img src="{{ asset($product->thumb_path) }}" class="image" alt="{{ $product->n_name_en }}"></a>
                                    @endif
                                </div>
                                <!-- /.products__part-image -->
                            </div>
                            <!-- /.col-4 col-lg-3 -->
                            <div class="col-12 col-lg-4">
                                @if(App::isLocale('en'))
                                    <div class="products__part-name">
                                        <a href="{{ route('singleNodePage', $product->id) }}">{{ $product->producer_id }}</a>
                                    </div>
                                @else
                                    <div class="products__part-name text-right" style="display: grid;">
                                        <a href="{{ route('singleNodePage', $product->id) }}">{{ $product->producer_id }}</a>
                                    </div>
                                @endif
                                <!-- /.products__part-name -->
                            </div>
                            <!-- /.col-12 col-lg-5 -->
                            <div class="col-12 col-lg-5">
                                @if(App::isLocale('en'))
                                    <div class="products__part-name">
                                        <a href="{{ route('singleNodePage', $product->id) }}">{{ $product->npf_name_en . ' - ' . $product->fig_name_en }}</a>
                                    </div>
                                @else
                                    <div class="products__part-name text-right" style="display: grid;">
                                        <a href="{{ route('singleNodePage', $product->id) }}">{{ $product->npf_name_ar . ' - ' . $product->fig_name_ar }}</a>
                                    </div>
                                @endif
                            </div>
                            <!-- /.col-12 col-lg-4 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-12 col-lg-7 -->
                    <div class="col-12 col-lg-5">
                        <form action="#" method="post" id="addToCartHandler">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="userKey">
                            <div class="d-flex justify-content-end products__part-cart">
                                <div class="products__part-cart-price">
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
                                <!-- /.products__part-cart-price -->
                                <div class="products__part-cart-qty">
                                    <div class="d-flex justify-content-around product__qty">
                                        <a href="#" class="sub-qty"><i class="fas fa-minus"></i></a>
                                        <input type="number" name="qty" id="qty_{{ $product->id }}" value="1" min="1" style="max-width: 40px;">
                                        <a href="#" class="add-qty"><i class="fas fa-plus"></i></a>
                                    </div>
                                    <!-- /.product__qty -->
                                </div>
                                <!-- /.products__part-cart-qty -->
                                <div class="products__part-cart-button">
                                    <button class="btn btn-add-to-cart" type="submit">
                                        @if(App::isLocale('en'))
                                            Add to cart
                                        @else
                                            أضف إلى السلة
                                        @endif
                                    </button>
                                    <!-- /.btn btn-add-to-cart -->
                                </div>
                                <!-- /.products__part-cart-button -->
                            </div>
                            <!-- /.d-flex justify-content-between products__part-cart -->
                        </form>
                    </div>
                    <!-- /.col-12 col-lg-5 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.products__part -->
        @endforeach
    </div>
    <!-- /.products__parts -->
</div>
<!-- /.col-12 -->
