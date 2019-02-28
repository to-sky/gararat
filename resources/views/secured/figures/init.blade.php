@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <form action="{{ route('saveConstructorInitAPI') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="figureNumber">Figure Number</label>
                        <input type="text" class="form-control" name="figureNumber" id="figureNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="figureCategory">Choose figure category</label>
                        <select name="figureCategory" id="figureCategory" class="form-control">
                            {!! $catalogs !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="figureImage">Upload Figure Image (Image width should be 850px. Other sizes will be scaled automatically.)</label>
                        <input type="file" class="form-control-file" name="figureImage" id="figureImage" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
