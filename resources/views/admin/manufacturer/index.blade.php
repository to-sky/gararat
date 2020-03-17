@extends('admin.layouts.master')

@section('title') Manufacturers @endsection

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.manufacturer.create'), 'item' => 'manufacturer'])
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
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($manufacturers as $manufacturer)
                        <tr>
                            <td>{{ $manufacturer->id }}</td>
                            <td>{{ $manufacturer->name }}</td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.manufacturer.edit', $manufacturer)
                                        ])

                                        @if ($manufacturer->equipment->isEmpty())
                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.manufacturer.destroy', $manufacturer),
                                                'modalText' => 'manufacturer "' . $manufacturer->name . '"'
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

            <div class="mt-2 pull-right">
                @if($manufacturers->isNotEmpty())
                    {{ $manufacturers->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'manufacturer'])
@endsection
