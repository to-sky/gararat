@extends('admin.layouts.master')

@section('title') Equipment group @endsection

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.equipment-group.create'), 'item' => 'equipment group'])
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
                    @foreach($equipmentGroups as $equipmentGroup)
                        <tr>
                            <td>{{ $equipmentGroup->id }}</td>
                            <td>{{ $equipmentGroup->name }}</td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.equipment-group.edit', $equipmentGroup)
                                        ])

                                        @if ($equipmentGroup->equipment->isEmpty())
                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.equipment-group.destroy', $equipmentGroup),
                                                'modalText' => 'equipment group "' . $equipmentGroup->name . '"'
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
                @if($equipmentGroups->isNotEmpty())
                    {{ $equipmentGroups->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'equipment group'])
@endsection
