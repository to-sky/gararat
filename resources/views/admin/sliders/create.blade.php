@extends('admin.layouts.master')

@section('title', 'Add slide')

@section('content')
    <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <div class="form-group">
                        <label for="slideTitle">Title</label>
                        <input type="text" class="form-control" name="sl_title" id="slideTitle" required>
                    </div>
                    <div class="form-group">
                        <p class="mb-1">Upload image</p>

                        @include('admin.includes._input-file', [
                            'name' => 'sl_image',
                            'label' => 'Size: 1110x400px',
                            'formats' => '.jpg,.png,.tiff'
                        ])

                        @include('admin.includes._image_following_formats')
                    </div>
                    <div class="form-group">
                        <label for="sliderDescription">Link</label>
                        <input type="text" class="form-control" name="sl_description" id="sliderDescription" placeholder="Example: /catalog/2">
                    </div>
                    <div class="form-group">
                        <label for="positionNumber">Position Number</label>
                        <input type="number" class="form-control" name="sl+order" id="positionNumber" value="1" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.sliders.index') ])
            </div>
        </div>
    </form>
@endsection
