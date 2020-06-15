@extends('admin.layouts.master')

@section('title') Search results for: {{ request('q') }} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if($products->isNotEmpty())
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Producer ID</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr style="line-height: 41px;">
                            <td>{{ $product->id }}</td>
                            <td>
                                <img src="{{ $product->getFirstMediaUrl('main_image', 'thumb') }}" width="50">
                            </td>
                            <td width="45%">{{ $product->name }}</td>
                            <td>{{ $product->producer_id}}</td>
                            <td>{!! $product->displayPrice() !!}</td>
                            <td>{{ $product->qty }}</td>
                            <td>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._show-btn' , [
                                           'href' => $product->path()
                                       ])

                                        @include('admin.includes._edit-btn' , [
                                            'href' => $product->path('edit')
                                        ])

                                        @include('admin.includes._delete-btn' , [
                                            'href' => $product->path('destroy'),
                                            'modalText' => Str::singular($product->getTable()) . ' "' . $product->name . '"'
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p>Products not found.</p>
            @endif

            <div class="mt-3 float-right">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'product'])
@endsection

