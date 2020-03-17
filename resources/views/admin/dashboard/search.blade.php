@extends('admin.layouts.master')

@section('title') Search results for: {{ request()->q }} @endsection

@include('admin.includes.blocks.delete-item-modal', ['item' => 'product'])

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
                            <td>
                                {{ $product->n_name_en }}
                                @if(isset($product->producer_id) && $product->producer_id !== null)
                                    <strong>Producer ID: {{ $product->producer_id }}</strong>
                                @endif
                            </td>
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
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.products.edit', ['product_type' => $product->cat_type, 'id' => $product->id])
                                        ])

                                        @include('admin.includes._delete-btn' , [
                                            'href' => route('removeProductAPI', ['id' => $product->id]),
                                            'modalText' => 'product "' .  $product->n_name_en . '"'
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3 pull-right">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
