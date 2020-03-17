@extends('admin.layouts.master')

@section('title') Orders @endsection

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
                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.order.edit', $order->id)
                                            ])

                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('removeOrderAPI', ['id' => $order->id]),
                                                'modalText' => 'order ' . $order->id
                                            ])
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-2 pull-right">
                @if($orders->isNotEmpty())
                    {{ $orders->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'order'])
@endsection