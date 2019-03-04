@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $catalogName }} for {{ $parentCatalog->cat_name_en }}</h1>
        <div class="drawing">
            <div class="row">
                <div class="col-12">
                    <div class="drawing__figure">
                        <div class="drawing__figure-wrapper">
                            <div class="drawing__figure-inner">
                                <img src="{{ asset($figure->fig_image) }}" alt="{{ $parentCatalog->cat_name_en }}">
                                @foreach($nodes as $node)
                                    @if($node->pos_x != 0 && $node->pos_y != 0)
                                        <div class="item-block" @if($node->in_stock === 1) data-stock="1" @else data-stock="0" @endif data-target="targetConstructorNode_{{ $node->nid }}" style="position: absolute; top: {{ $node->pos_y - ($node->size_y / 2) }}px; left: {{ $node->pos_x - ($node->size_x / 2) }}px; border: 1px solid {{ $node->color }}; z-index: 9999; width: {{ $node->size_x }}px; height: {{ $node->size_y }}px;"></div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- /.drawing__figure-inner -->
                        </div>
                        <!-- /.drawing__figure-wrapper -->
                    </div>
                    <!-- /.drawing__figure -->
                    <div class="drawing__nodes">
                        <div class="responsive-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Pos. #</th>
                                    <th>Assembly unit or part number</th>
                                    <th>Q-ty</th>
                                    <th>Description</th>
                                    <th>Order</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($nodes as $node)
                                    <tr id="targetConstructorNode_{{ $node->nid }}">
                                        <td>{{ $node->pos_no }}</td>
                                        <td>{{ $node->n_name_en }}</td>
                                        <td>{{ $node->qty }}</td>
                                        <td>{{ $node->fig_name_en }}</td>
                                        <td>
                                            @if($node->in_stock === 1)
                                                <a href="#" class="collapsible-row-activator" data-target="collapsibleNode_{{ $node->nid }}">to order</a>
                                            @else
                                                <span>not supply</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($node->in_stock === 1)
                                        <tr class="collapsible-row" id="collapsibleNode_{{ $node->nid }}">
                                            <td colspan="5">
                                                <form action="#" method="post" id="addToCartHandler">
                                                    @csrf
                                                    <input type="hidden" name="nid" value="{{ $node->nid }}">
                                                    <input type="hidden" name="userKey">
                                                    <div class="d-flex justify-content-end products__part-cart">
                                                        <div class="products__part-cart-qty">
                                                            <div class="d-flex justify-content-around product__qty">
                                                                <a href="#" class="sub-qty"><i class="fas fa-minus"></i></a>
                                                                <input type="number" name="qty" id="qty_{{ $node->nid }}" value="1" min="1" style="max-width: 40px;">
                                                                <a href="#" class="add-qty"><i class="fas fa-plus"></i></a>
                                                            </div>
                                                            <!-- /.product__qty -->
                                                        </div>
                                                        <!-- /.products__part-cart-qty -->
                                                        <div class="products__part-cart-price">
                                                            @if($node->special_price !== NULL && $node->special_price != 0)
                                                                <span class="old">${{ number_format($node->price, 0, '.', ' ') }}</span>
                                                                <span class="current current-special">${{ number_format($node->special_price, 0, '.', ' ') }}</span>
                                                            @else
                                                                <span class="current">${{ number_format($node->price, 0, '.', ' ') }}</span>
                                                            @endif
                                                        </div>
                                                        <!-- /.products__part-cart-price -->
                                                        <div class="products__part-cart-button">
                                                            <button class="btn btn-add-to-cart" type="submit">Add to cart</button>
                                                            <!-- /.btn btn-add-to-cart -->
                                                        </div>
                                                        <!-- /.products__part-cart-button -->
                                                    </div>
                                                    <!-- /.d-flex justify-content-between products__part-cart -->
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.responsive-table -->
                    </div>
                    <!-- /.drawing__nodes -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.drawing -->
    </div>
    <!-- /.container -->
@endsection
