@extends('admin.layouts.master')

@section('title', "Edit slide: $slide->slide_number")

@section('content')
    <form action="{{ route('admin.slides.update', $slide) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="previous_page" value="{{ URL::previous() }}">
        @method('PUT')
        @csrf

        <div class="card mb-3 rounded-0 border">
            <div class="card-body">
                <div class="form-group">
                    @include('admin.includes._body', ['tinymceClass' => 'tinymce-lite', 'item' => $slide])
                </div>

                <div class="form-group row">
                    <div class="col-md-9">
                        <label for="link">Link</label>
                        <input type="text" name="link" class="form-control" id="link" value="{{ $slide->link }}"  placeholder="Button link">
                    </div>

                    <div class="col-md-2">
                        <label for="slideNumber">Slide number</label>
                        <input type="number" name="slide_number" class="form-control" id="slideNumber" min="1" step="1"
                               value="{{ $slide->slide_number }}">
                    </div>

                    <div class="col-md-1">
                        <div class="custom-control custom-switch mt-4 pt-2">
                            <input type="hidden" name="blackout" value="0">
                            <input type="checkbox" name="blackout" class="custom-control-input" id="blackout" value="1"
                                {{ $slide->blackout ? 'checked' : '' }}>
                            <label class="custom-control-label" for="blackout">Blackout</label>
                        </div>
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

                        @if (isset($slide) && $mainImage = $slide->getFirstMedia('home_slide'))
                            @include('admin.includes._form-image', [
                                'mediaItem' => $mainImage,
                                'class' => 'w-25'
                            ])
                        @endif
                    </div>

                    <div class="col-md-6">
                        <p class="mb-1">Slide mobile</p>
                        @include('admin.includes._input-file', [
                            'name' => 'home_slide_mobile',
                            'label' => 'Size: 400x400px',
                            'formats' => '.jpg,.png,.tiff'
                        ])

                        @include('admin.includes._image_following_formats')

                        @if (isset($slide) && $mainImageMobile = $slide->getFirstMedia('home_slide_mobile'))
                            @include('admin.includes._form-image', [
                                'mediaItem' => $mainImageMobile,
                                'class' => 'w-25'
                            ])
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('admin.includes.blocks.save-or-back-btns', [
                    'href' => URL::previous()
                ])
            </div>
        </div>
    </form>
@endsection
