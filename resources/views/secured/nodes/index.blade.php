@extends('layouts.secured')

@section('title') {{ $product_type ? 'Parts' : 'Equipment' }} @endsection

@section('button')
    @include('includes.secured.elements._add-btn', [
    'href' => route('admin.products.create', ['product_type' => $product_type]), 'item' => $product_type ? 'part' : 'equipment'
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            @if($product_type == 1)
                                <th>Producer ID</th>
                            @endif
                            <th>Price</th>
                            <th>In Stock?</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
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
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('includes.secured.elements._edit-btn' , [
                                                'href' => route('admin.products.edit', ['product_type' => $product_type, 'id' => $product->id])
                                            ])

                                            @include('includes.secured.elements._delete-btn' , [
                                                'href' => route('removeProductAPI', $product->id),
                                                'modalText' => 'product "' . $product->n_name_en . '"'
                                            ])
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-20 pull-right">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    @include('includes.secured.modals._deleteItem', ['item' => $product_type ? 'part' : 'equipment'])
@endsection
