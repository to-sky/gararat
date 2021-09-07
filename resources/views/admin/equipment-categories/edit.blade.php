@extends('admin.layouts.master')

@section('title', "Edit equipment category: $equipmentCategory->name")

@section('content')
    <form action="{{ route('admin.equipment-categories.update', $equipmentCategory) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="previous_page" value="{{ URL::previous() }}">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $equipmentCategory])
            <div class="form-group">
                <label for="description">Description</label>
                <div class="input-group">
                    <textarea rows="5"
                              name="description"
                              id="description"
                              class="form-control"
                              placeholder="English">{{ $equipmentCategory->description ?? old('description') }}</textarea>
                    <textarea rows="5"
                              name="description_ar"
                              class="form-control"
                              placeholder="Arabic">{{ $equipmentCategory->description_ar ?? old('description_ar') }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <p class="mb-1">Image</p>
                @include('admin.includes._input-file', [
                    'name' => 'image',
                    'formats' => '.jpg,.png,.tiff'
                ])
                @include('admin.includes._image_following_formats')

                <div class="d-flex">
                    @if ($image = $equipmentCategory->getFirstMedia('image'))
                        @include('admin.includes._form-image', [
                            'mediaItem' => $image
                        ])
                    @endif
                </div>
            </div>
        @endcomponent

        <div class="card form-group rounded-0 border">
            <div class="card-header border-0">
                <h5 class="mb-0">
                    <span>Subcategories</span>
                </h5>
            </div>
            <div class="card-body repeater">
                <div class="inputs border-top-0">
                    <div data-repeater-list="subcategories">
                        @forelse($equipmentCategory->childs as $num => $equipmentCategoryChild)
                            @include('admin.equipment-categories.includes._equipment_subcategory_item', [
                                'item' => $equipmentCategoryChild,
                                'num' => $num
                            ])
                        @empty
                            @include('admin.equipment-categories.includes._equipment_subcategory_item')
                        @endforelse
                    </div>
                </div>

                <button data-repeater-create type="button"
                        class="btn btn-outline-light btn-block shadow-sm text-success border">
                    <i class="ti-plus"></i> Add subcategory
                </button>
            </div>
        </div>

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => URL::previous()
        ])
    </form>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'equipment subcategory'])
@endsection



@push('scripts')
    <script>
        $('.repeater').repeater({
            show: function () {
                $(this).find('button').data('delete-url', '')
                $(this).show();
            },
            hide: function (deleteElement) {
                let item = $(this).get(0)
                let subcategoryName = $(item).attr('data-item-name');
                let deleteBtn = $(this).find('button');
                let deleteUrl = deleteBtn.data('delete-url');
                let canBeDeleted = deleteBtn.data('can-be-deleted');

                let title, content;
                let buttons = {
                    cancel: {
                        btnClass: 'btn-outline-secondary',
                        action: function() {
                            this.close();
                        }
                    }
                }

                if (canBeDeleted) {
                    title = '<p>Delete subcategory</p>';
                    content = `Are you sure you want to delete "<b>${subcategoryName}</b>"?`
                    buttons.confirm = {
                        text: 'Delete',
                        btnClass: 'btn-outline-danger',
                        action: function() {
                            $.post({
                                url: deleteUrl,
                                type: 'DELETE',
                                success: function (){
                                    $(this).slideUp(deleteElement);
                                }
                            });
                        }
                    }
                } else {
                    title = '<p>Sorry</p>';
                    content = `You can't delete "<b>${subcategoryName}</b>"?`
                }

                if (! deleteUrl.length) {
                    return deleteElement();
                }

                $.confirm({
                    title: title,
                    content: content,
                    type: 'red',
                    icon: 'far fa-frown',
                    closeIcon: true,
                    theme: 'modern',
                    animation: 'scale',
                    buttons: buttons
                });
            }
        });
    </script>
@endpush
