@extends('admin.layouts.master')

@section('title') Edit order: {{ $order->id }} @endsection

@include('admin.includes.blocks.delete-item-modal', ['item' => 'product'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bd bg-white">
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
                            <td class="pt-30">Status</td>
                            <td class="pt-20">
                                <form action="{{ route('changeOrderStatusAPI') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input type="hidden" name="id" value="{{ $order->id }}">
                                                <select class="form-control" name="orderStatus" id="orderStatus" autocomplete="off">
                                                    <option @if($order->status == 0) selected @endif value="0">Queue</option>
                                                    <option @if($order->status == 1) selected @endif value="1">In Progress</option>
                                                    <option @if($order->status == 2) selected @endif value="2">Completed</option>
                                                    <option @if($order->status == 3) selected @endif value="3">Canceled</option>
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
            <div class="bgc-white bd mt-30">
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
                        @foreach($order->nodes as $node)
                            <tr>
                                <td>{{ $node->id }}</td>
                                <td>
                                    <img src="{{ asset($node->getImageOrEmpty()) }}" height="26">
                                </td>
                                <td>{{ $node->n_name_en }}</td>
                                <td>
                                    @if($node->is_special != 0)
                                        EGP {{ number_format($node->special_price, 2, '.', ' ') }} <small><s>{{ number_format($node->price, 2, '.', ' ') }}</s></small>
                                    @else
                                        EGP {{ number_format($node->price, 2, '.', ' ') }}
                                    @endif
                                </td>
                                <td>{{ $node->pivot->order_qty }}</td>
                                <td>{{ $node->sum_per_qty }}</td>
                                <td>
                                    <div class="pull-right">
                                        @include('admin.includes._delete-btn' , [
                                               'href' => route('removeProductFromOrderAPI', ['order_id' => $order->id, 'node_id' => $node->id]),
                                               'modalText' => 'product "' . $node->n_name_en . '"'
                                           ])
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="text-uppercase fsz-md pt-15 text-right text-black-50">Total: <strong>{{ $order->displayTotalPrice() }}</strong></p>
        </div>
    </div>
@endsection
