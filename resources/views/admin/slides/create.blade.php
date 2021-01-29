@extends('admin.layouts.master')

@section('title', 'Add slide')

@section('content')
    <form action="{{ route('admin.slides.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card mb-3 rounded-0 border">
            <div class="card-body">
                <div class="form-group">
                    @include('admin.includes._body', ['tinymceClass' => 'tinymce-lite'])
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="link">Link</label>
                        <input type="text" name="link" class="form-control" id="link" placeholder="Button link">
                    </div>

                    <div class="col-md-4">
                        <label for="textPosition">Text position</label>
                        <select class="custom-select" id="textPosition" name="text_position">
                            <option value="{{ App\Models\Slide::TEXT_LEFT }}">Left</option>
                            <option value="{{ App\Models\Slide::TEXT_CENTER }}">Center</option>
                            <option value="{{ App\Models\Slide::TEXT_RIGHT }}">Right</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="slideNumber">Slide number</label>
                        <input type="number" name="slide_number" class="form-control" id="slideNumber" min="1" step="1" value="1">
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-6">
                        <p class="mb-1">Slide</p>
                        @include('admin.includes._input-file', [
                            'name' => 'home_slide',
                            'label' => 'Size: 1200x400px',
                            'formats' => '.jpg,.png,.tiff'
                        ])

                        @include('admin.includes._image_following_formats')
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1">Slide mobile</p>
                        @include('admin.includes._input-file', [
                            'name' => 'home_slide_mobile',
                            'label' => 'Size: 400x400px',
                            'formats' => '.jpg,.png,.tiff'
                        ])

                        @include('admin.includes._image_following_formats')
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.slides.index') ])
            </div>
        </div>
    </form>
@endsection
