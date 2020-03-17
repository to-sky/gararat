@extends('admin.layouts.master')

@section('title') Edit slide: {{ $slider->sl_id }} @endsection

@section('content')
    <form action="{{ route('updateSlideAPI') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <input type="hidden" name="sliderId" value="{{ $slider->sl_id }}">
                    <div class="form-group">
                        <label for="slideTitle">Title</label>
                        <input type="text" class="form-control" name="slideTitle" id="slideTitle" required value="{{ $slider->sl_title }}">
                    </div>
                    <div class="form-group">
                        <p class="mb-1">Upload New Image To Replace Current</p>

                        @include('admin.includes._input-file', [
                            'name' => 'slideImage',
                            'label' => 'Size: 1110x400px',
                            'placeholder' => $slider->sl_image
                        ])

                        <p class="mt-2 mb-0">
                            <img src="{{ asset($slider->sl_image) }}" height="64" alt="{{ $slider->sl_title }}">
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="sliderDescription">Link</label>
                        <input type="text" class="form-control" name="sliderDescription" id="sliderDescription" placeholder="Example: /catalog/2" value="{{ $slider->sl_description }}">
                    </div>
                    <div class="form-group">
                        <label for="positionNumber">Position Number</label>
                        <input type="number" class="form-control" name="positionNumber" id="positionNumber" placeholder="1" value="{{ $slider->sl_order }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.slider.index') ])
            </div>
        </div>
    </form>
@endsection
