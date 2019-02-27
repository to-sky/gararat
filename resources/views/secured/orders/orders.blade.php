@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order['oid'] }}</td>
                                <td>{{ $order['customer'] }}</td>
                                <td>{{ $order['total'] }}</td>
                                <td>
                                    @switch($order['status'])
                                        @case(0)
                                            Queued
                                            @break
                                        @case(1)
                                            In Progress
                                            @break
                                        @case(2)
                                            Completed
                                            @break
                                        @case(3)
                                            Canceled
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order['created_at'])->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('reviewOrderPageSecured', $order['oid']) }}" class="btn btn-success"><i class="ti-pencil"></i></a>
                                    <a href="{{ route('removeOrderAPI', ['oid' => $order['oid']]) }}" class="btn btn-danger"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
