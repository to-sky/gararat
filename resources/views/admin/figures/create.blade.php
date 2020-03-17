@extends('admin.layouts.master')

@section('title') New figure @endsection

@section('content')
    <form action="{{ route('saveConstructorInitAPI') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <div class="form-group">
                        <label for="figureNumber">Figure Number</label>
                        <input type="text" class="form-control" name="figureNumber" id="figureNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="figureCategory">Choose figure category</label>
                        <select name="figureCategory" id="figureCategory" class="form-control select2-element">
                            {!! $catalogRender !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <p class="mb-1">Upload Figure Image (Image width should be 850px. Other sizes will be scaled automatically.)</p>
                        @include('admin.includes._input-file', [
                            'name' => 'figureImage',
                            'label' => 'Figure image'
                        ])
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.figures.index') ])
            </div>
        </div>
    </form>
@endsection
