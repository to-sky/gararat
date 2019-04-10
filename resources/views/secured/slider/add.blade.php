@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <form action="{{ route('saveNewSlideAPI') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="slideTitle">Title</label>
                        <input type="text" class="form-control" name="slideTitle" id="slideTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="slideImage">Upload Image (1110 x 400px)</label>
                        <input type="file" class="form-control-file" name="slideImage" id="slideImage" required>
                    </div>
                    <div class="form-group">
                        <label for="sliderDescription">Link</label>
                        <input type="text" class="form-control-file" name="sliderDescription" id="sliderDescription" placeholder="Example: /catalog/2">
                    </div>
                    <div class="form-group">
                        <label for="positionNumber">Position Number</label>
                        <input type="number" class="form-control" name="positionNumber" id="positionNumber" value="1" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
