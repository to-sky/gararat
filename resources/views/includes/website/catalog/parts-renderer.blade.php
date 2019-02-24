<div class="col-12">
    <div class="products__parts-filters">
        <div class="d-flex justify-content-between">
            <div class="sorting-listing-by">
                <span>Sorting listing by:</span>
                <a @if($target == 'price') class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'price', 'dest' => $neededTarget, 'per_page' => $perPage]) }}">
                    Price
                    @if($neededTarget == 'ASC')
                        <i class="fas fa-sort-amount-down"></i>
                    @else
                        <i class="fas fa-sort-amount-up"></i>
                    @endif
                </a>
                <a @if($target == 'n_name_en') class="active" @endif href="{{ route('catalogPage', ['cid' => $cid, 'target' => 'n_name_en', 'dest' => $neededTarget, 'per_page' => $perPage]) }}">
                    Name
                    @if($neededTarget == 'ASC')
                        <i class="fas fa-sort-alpha-down"></i>
                    @else
                        <i class="fas fa-sort-alpha-up"></i>
                    @endif
                </a>
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
    <div class="products__parts">
        @foreach($products as $product)
            <div class="products__part">
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="row">
                            <div class="col-4 col-lg-3">
                                <div class="products__part-image">
                                    @if($product->has_photo === 0)
                                        <img src="{{ asset('assets/logos/logo.jpg') }}" class="image" alt="{{ $product->n_name_en }}">
                                    @else
                                        <img src="{{ asset($product->thumb_path) }}" class="image" alt="{{ $product->n_name_en }}">
                                    @endif
                                </div>
                                <!-- /.products__part-image -->
                            </div>
                            <!-- /.col-4 col-lg-3 -->
                            <div class="col-8 col-lg-9">
                                <div class="products__part-name">
                                    {{ $product->n_name_en }}
                                </div>
                                <!-- /.products__part-name -->
                            </div>
                            <!-- /.col-8 col-lg-9 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col-12 col-lg-7 -->
                    <div class="col-12 col-lg-5">
                        <form action="#" method="post" id="addToCartHandler">
                            @csrf
                            <input type="hidden" name="nid" value="{{ $product->nid }}">
                            <input type="hidden" name="userKey">
                            <div class="d-flex justify-content-end products__part-cart">
                                <div class="products__part-cart-price">
                                    @if($product->special_price !== NULL && $product->special_price != 0)
                                        <span class="old">${{ number_format($product->price, 0, '.', ' ') }}</span>
                                        <span class="current current-special">${{ number_format($product->special_price, 0, '.', ' ') }}</span>
                                    @else
                                        <span class="current">${{ number_format($product->price, 0, '.', ' ') }}</span>
                                    @endif
                                </div>
                                <!-- /.products__part-cart-price -->
                                <div class="products__part-cart-qty">
                                    <div class="d-flex justify-content-around product__qty">
                                        <a href="#" class="sub-qty"><i class="fas fa-minus"></i></a>
                                        <input type="number" name="qty" id="qty_{{ $product->nid }}" value="1" min="1" style="max-width: 40px;">
                                        <a href="#" class="add-qty"><i class="fas fa-plus"></i></a>
                                    </div>
                                    <!-- /.product__qty -->
                                </div>
                                <!-- /.products__part-cart-qty -->
                                <div class="products__part-cart-button">
                                    <button class="btn btn-add-to-cart" type="submit">Add to cart</button>
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