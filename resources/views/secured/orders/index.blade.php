@extends('layouts.secured')

@section('title') Orders @endsection

@include('includes.secured.modals._deleteItem', ['item' => 'order'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd pb-15">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->full_name }}</td>
                                <td>{{ $order->displayTotalPrice() }}</td>
                                <td>{{ $order->displayStatus() }}</td>
                                <td>{{ $order->created }}</td>
                                <td>
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('includes.secured.elements._edit-btn' , [
                                                'href' => route('admin.order.edit', $order->id)
                                            ])

                                            @include('includes.secured.elements._delete-btn' , [
                                                'href' => route('removeOrderAPI', ['id' => $order->id]),
                                                'modalText' => 'order №' . $order->id
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
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection