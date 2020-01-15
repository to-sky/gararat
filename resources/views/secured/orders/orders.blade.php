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
                                <td>{{ $order['id'] }}</td>
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
                                    <a href="{{ route('reviewOrderPageSecured', $order['id']) }}" class="btn btn-success"><i class="ti-pencil"></i></a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">Delete?</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('removeOrderAPI', ['id' => $order['id']]) }}">Yes, remove</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
