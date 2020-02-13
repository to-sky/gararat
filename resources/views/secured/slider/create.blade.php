@extends('layouts.secured')

@section('title') Add slide @endsection

@section('content')
    <form action="{{ route('saveNewSlideAPI') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <div class="form-group">
                        <label for="slideTitle">Title</label>
                        <input type="text" class="form-control" name="slideTitle" id="slideTitle" required>
                    </div>
                    <div class="form-group">
                        <p class="mb-1">Upload image</p>

                        @include('includes.secured.elements._input-file', [
                            'name' => 'slideImage',
                            'label' => 'Size: 1110x400px'
                        ])
                    </div>
                    <div class="form-group">
                        <label for="sliderDescription">Link</label>
                        <input type="text" class="form-control" name="sliderDescription" id="sliderDescription" placeholder="Example: /catalog/2">
                    </div>
                    <div class="form-group">
                        <label for="positionNumber">Position Number</label>
                        <input type="number" class="form-control" name="positionNumber" id="positionNumber" value="1" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('includes.secured.elements._save_or_back_btns', ['href' => route('admin.slider.index') ])
            </div>
        </div>
    </form>
@endsection
