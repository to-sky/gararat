@extends('admin.layouts.master')

@section('title', "Edit order: $order->id")

@section('content')
    <div class="card mb-3 rounded-0 border border-top-0">
        <table class="table table-stripped m-0 fsz-sm">
            <tbody >
                <tr>
                    <td>Name</td>
                    <td>{{ $order->full_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $order->email }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $order->phone }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $order->full_address }}</td>
                </tr>
                <tr>
                    <td>Comment</td>
                    <td>{{ $order->comment }}</td>
                </tr>
                <tr>
                    <td>Created</td>
                    <td>{{ $order->created }}</td>
                </tr>
                <tr>
                    <td>
                        <label for="orderStatus">Status</label>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.changeStatus', $order) }}" method="post" autocomplete="off">
                            @method('PATCH')
                            @csrf

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10">
                                        <select class="form-control" name="order_status" id="orderStatus" autocomplete="off">
                                            @foreach(\App\Models\Order::getStatuses() as $key => $statusName)
                                            <option @if($order->status == $key) selected @endif value="{{ $key }}">
                                                {{ $statusName }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success w-100" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="card mb-3 rounded-0 border">
        <table class="table table-borderless table-hover table-striped mb-0">
            <thead class="shadow-sm">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total price</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->orderProducts as $orderProduct)
                    <tr>
                        <td>{{ $orderProduct->product->id }}</td>
                        <td>
                            <img src="{{ asset($orderProduct->product->getFirstMediaUrl('main_image', 'thumb')) }}" width="50">
                        </td>
                        <td>{{ $orderProduct->product->name }}</td>
                        <td>{!! displayPrice($orderProduct->price, $orderProduct->product) !!}</td>
                        <td>{{ $orderProduct->qty }}</td>
                        <td>{!! displayPrice($orderProduct->total, $orderProduct->product) !!}</td>
                        <td>
                            <div class="pull-right">
                                <div class="btn-group btn-group-sm shadow-sm" role="group">
                                    @include('admin.includes._show-btn' , [
                                        'href' => route('admin.'.$orderProduct->product->getTable().'.edit', $orderProduct->product)
                                    ])

                                    @if($order->status !== \App\Models\Order::STATUS_COMPLETED)
                                        @include('admin.includes._delete-btn' , [
                                           'href' => route('admin.orders.deleteProduct', $orderProduct),
                                           'modalText' => 'product "' . $orderProduct->product->name . '"'
                                       ])
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p class="text-uppercase fsz-md pt-15 text-right text-black-50">Total: <strong>{{ getFormattedPrice($order->total) }}</strong></p>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'product'])
@endsection