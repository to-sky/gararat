@extends('admin.layouts.master')

@section('title', 'Equipment categories')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.equipment-categories.create'), 'item' => 'equipment category'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd pb-15">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Subcategories</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($equipmentCategories as $equipmentCategory)
                        <tr data-id="{{ $equipmentCategory->id }}">
                            <td>{{ $equipmentCategory->id }}</td>
                            <td>
                                <img src="{{ asset($equipmentCategory->getFirstMediaUrl('image', 'thumb')) }}" width="50">
                            </td>
                            <td>{{ $equipmentCategory->name }}</td>
                            <td>{{ Str::limit($equipmentCategory->description, 60) }}</td>
                            <td>
                                @forelse($equipmentCategory->childs as $equipmentCategoryChild)
                                    <span class="p-4 border rounded fsz-xs mr-2">{{ $equipmentCategoryChild->name }}</span>
                                @empty
                                    <span>No subcategories</span>
                                @endforelse
                            </td>
                            <td>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.equipment-categories.edit', $equipmentCategory)
                                        ])

                                        @empty($equipmentCategory->childEquipment->count())
                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.equipment-categories.destroy', $equipmentCategory),
                                                'modalText' => 'equipment category "' . $equipmentCategory->name . '"'
                                            ])
                                        @endempty
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

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'equipment category'])
@endsection

@push('scripts')
    <script>
        // Add sortable plugin (Drag'n'Drop tr)
        $( "#sortable" ).sortable({
            update: function() {
                let equipmentCategoryIds = $(this).find('tr').map(function(i, el) {
                    return $(el).data('id');
                });

                $.ajax({
                    type: 'PUT',
                    url: '{{ route('admin.equipment-categories.update-site-position') }}',
                    data: {
                        equipmentCategoryIds: equipmentCategoryIds.toArray()
                    }
                });
            }
        });
    </script>
@endpush
