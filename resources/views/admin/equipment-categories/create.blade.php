@extends('admin.layouts.master')

@section('title', 'Add equipment category')

@section('content')
    <form action="{{ route('admin.equipment-categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @component('admin.components.name')
            <div class="form-group">
                <label for="description">Description</label>
                <div class="input-group">
                    <textarea rows="5" name="description" id="description" class="form-control" placeholder="English">{{ old('description') }}</textarea>
                    <textarea rows="5" name="description_ar" class="form-control" placeholder="Arabic">{{ old('description_ar') }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <p class="mb-1">Image</p>
                @include('admin.includes._input-file', [
                    'name' => 'image',
                    'placeholder' => 'Select image',
                    'formats' => '.jpg,.png,.tiff'
                ])
                @include('admin.includes._image_following_formats')
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
                        @include('admin.equipment-categories.includes._equipment_subcategory_item')
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
@endsection

@push('scripts')
    <script>
        $('.repeater').repeater();
    </script>
@endpush
