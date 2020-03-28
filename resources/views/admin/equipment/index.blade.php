@extends('admin.layouts.master')

@section('title') Equipment @endsection

@section('button')
    @include('admin.includes._add-btn', [
        'href' => route('admin.equipment.create'), 'item' => 'equipment'
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>In stock</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach($equipment as $item)
                            <tr style="line-height: 41px;" data-id="{{ $item->id }}">
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ asset($item->getFirstMediaUrl('main_image', 'thumb')) }}" width="50">
                                </td>
                                <td width="45%">{{ $item->name }}</td>
                                <td>{!! $item->displayPrice() !!}</td>
                                <td>{{ $item->displayInStock() }}</td>
                                <td>
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('admin.includes._show-btn' , [
                                                'href' => route('equipment.show', $item)
                                            ])

                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.equipment.edit', $item)
                                            ])

                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.equipment.destroy', $item),
                                                'modalText' => 'equipment "' . $item->name . '"'
                                            ])
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

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'equipment'])
@endsection

@push('scripts')
    <script>
        // Add sortable plugin (Drag'n'Drop tr)
        $( "#sortable" ).sortable({
            update: function() {
                let equipmentIds = $(this).find('tr').map(function(i, el) {
                    return $(el).data('id');
                });

                $.ajax({
                    type: 'PUT',
                    url: '{{ route('admin.equipment.update-site-position') }}',
                    data: {
                        equipmentIds: equipmentIds.toArray()
                    }
                });
            }
        });
    </script>
@endpush