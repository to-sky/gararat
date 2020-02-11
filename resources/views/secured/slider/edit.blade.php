@extends('layouts.secured')

@section('title') Slide {{ $slider->sl_id }} @endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <form action="{{ route('updateSlideAPI') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="sliderId" value="{{ $slider->sl_id }}">
                    <div class="form-group">
                        <label for="slideTitle">Title</label>
                        <input type="text" class="form-control" name="slideTitle" id="slideTitle" required value="{{ $slider->sl_title }}">
                    </div>
                    <div class="form-group">
                        <p>Upload New Image To Replace Current</p>
                        <img src="{{ asset($slider->sl_image) }}" height="64" alt="">
                        <br><br><br>
                        <label for="slideImage">Upload Image (1110 x 400px)</label>
                        <input type="file" class="form-control-file" name="slideImage" id="slideImage">
                    </div>
                    <div class="form-group">
                        <label for="sliderDescription">Link</label>
                        <input type="text" class="form-control-file" name="sliderDescription" id="sliderDescription" placeholder="Example: /catalog/2" value="{{ $slider->sl_description }}">
                    </div>
                    <div class="form-group">
                        <label for="positionNumber">Position Number</label>
                        <input type="number" class="form-control" name="positionNumber" id="positionNumber" placeholder="1" value="{{ $slider->sl_order }}" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
