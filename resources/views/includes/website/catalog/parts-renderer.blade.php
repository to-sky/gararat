<div class="col-12">
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
                        <form action="#" method="post">
                            <div class="d-flex justify-content-between products__part-cart">
                                <div class="products__part-cart-price">
                                    @if($product->special_price !== NULL && $product->special_price != 0)
                                        <span class="old">${{ number_format($product->price, 0, '.', ' ') }}</span>
                                        <span class="current">${{ number_format($product->special_price, 0, '.', ' ') }}</span>
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
