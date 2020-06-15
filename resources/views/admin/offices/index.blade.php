@extends('admin.layouts.master')

@section('title', 'Offices')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.offices.create'), 'item' => 'office'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd pb-15">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offices as $office)
                        <tr>
                            <td>{{ $office->id }}</td>
                            <td>{{ $office->name }}</td>
                            <td>{{ $office->address }}</td>
                            <td>{{ $office->email }}</td>
                            <td>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.offices.edit', $office)
                                        ])

                                        @include('admin.includes._delete-btn' , [
                                            'href' => route('admin.offices.destroy', $office),
                                            'modalText' => 'office "' . $office->name . '"'
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-2 float-right">
                {{ $offices->links() }}
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'office'])
@endsection
