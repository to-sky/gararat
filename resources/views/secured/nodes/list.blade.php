@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            @if($product_type == 1)
                                <th>Producer ID</th>
                            @endif
                            <th>Price</th>
                            <th>In Stock?</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->nid }}</td>
                                @if($product->has_photo != 0)
                                    <td><img src="{{ asset($product->thumb_path) }}" height="26"></td>
                                @else
                                    <td><img src="{{ asset('assets/logos/logo.jpg') }}" height="26"></td>
                                @endif
                                <td style="width: 45%;">{{ $product->n_name_en }}</td>
                                @if($product_type == 1)
                                    <td>{{ $product->producer_id }}</td>
                                @endif
                                <td>
                                    @if($product->is_special != 0)
                                        {{ number_format($product->special_price, 2, '.', ' ') }} <small><s>{{ number_format($product->price, 2, '.', ' ') }}</s></small>
                                    @else
                                        {{ number_format($product->price, 2, '.', ' ') }}
                                    @endif
                                </td>
                                <td>
                                    @switch($product->in_stock)
                                        @case(1)
                                            Yes
                                            @break
                                        @case(0)
                                            No
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('editNode', ['product_type' => $product_type, 'nid' => $product->nid]) }}" class="btn btn-success"><i class="ti-pencil"></i></a>
                                    <a href="{{ route('removeProductAPI', $product->nid) }}" class="btn btn-danger"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $products->links() }}
@endsection
