@extends('admin.layouts.master')

@section('title', 'Add slide')

@section('content')
    <form action="{{ route('admin.slides.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card mb-3 rounded-0 border">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <div class="input-group">
                        <input type="text" name="title"
                               class="form-control"
                               placeholder="English" value="{{ old('title') }}">

                        <input type="text" name="title_ar" class="form-control"
                               placeholder="Arabic" value="{{ old('title_ar') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="shortDescription">Sub title</label>
                    <div class="input-group">
                        <textarea rows="5" name="sub_title" id="subTitle" class="form-control" placeholder="English">{{ old('sub_title') }}</textarea>
                        <textarea rows="5" name="sub_title_ar" id="subTitleAr" class="form-control" placeholder="Arabic">{{ old('sub_title_ar') }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="link">Link</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ config('app.url') }}</span>
                            </div>
                            <input type="text" name="link" class="form-control" id="link">
                        </div>
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
                    <div class="col-md-12">
                        <p class="mb-1">Slide</p>
                        @include('admin.includes._input-file', [
                            'name' => 'home_slide',
                            'label' => 'Size: 1920x500px',
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
