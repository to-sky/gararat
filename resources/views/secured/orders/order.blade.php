@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
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
                            <td>{{ $order->country . ', ' . $order->city . ', ' . $order->address }}</td>
                        </tr>
                        <tr>
                            <td>Comment</td>
                            <td>{{ $order->comment }}</td>
                        </tr>
                        <tr>
                            <td>Created</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <form action="{{ route('changeOrderStatusAPI') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                        <select class="form-control" name="orderStatus" id="orderStatus" autocomplete="off">
                                            <option @if($order->status == 0) selected @endif value="0">Queue</option>
                                            <option @if($order->status == 1) selected @endif value="1">In Progress</option>
                                            <option @if($order->status == 2) selected @endif value="2">Completed</option>
                                            <option @if($order->status == 3) selected @endif value="3">Canceled</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">Save</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bgc-white p-20 bd" style="margin-top: 30px;">
                <h6 class="c-grey-900">Products</h6>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $totalPrice = 0; ?>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                @if($product->has_photo != 0)
                                    <td><img src="{{ asset($product->thumb_path) }}" height="26"></td>
                                @else
                                    <td><img src="{{ asset('assets/logos/logo.jpg') }}" height="26"></td>
                                @endif
                                <td>{{ $product->n_name_en }}</td>
                                <td>
                                    @if($product->is_special != 0)
                                        ${{ number_format($product->special_price, 0, '.', ' ') }} <small><s>{{ number_format($product->price, 2, '.', ' ') }}</s></small>
                                    @else
                                        ${{ number_format($product->price, 0, '.', ' ') }}
                                    @endif
                                </td>
                                <td>
                                    {{ $product->order_qty }}
                                </td>
                                <td>
                                    @if($product->is_special != 0)
                                        ${{ number_format(($product->special_price * $product->order_qty), 0, '.', ' ') }}
                                        <?php  $totalPrice = $totalPrice + ($product->special_price * $product->order_qty); ?>
                                    @else
                                        ${{ number_format(($product->price * $product->order_qty), 0, '.', ' ') }}
                                        <?php  $totalPrice = $totalPrice + ($product->price * $product->order_qty); ?>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('removeProductFromOrderAPI', ['order_id' => $order->id, 'node_id' => $product->id]) }}" class="btn btn-danger"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5>Total price: <strong>${{ number_format($totalPrice, 0, ',', ' ') }}</strong></h5>
            </div>
        </div>
    </div>
@endsection
