@extends('admin.layouts.master')

@section('title', 'Add news')

@section('content')
    <form action="{{ route('admin.news.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card mb-3 rounded-0 border">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title*</label>
                    <div class="input-group">
                        <input type="text" name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="English" value="{{ isset($item) ? $item->title : old('title') }}" required>

                        <input type="text" name="title_ar" class="form-control @error('title_ar') is-invalid @enderror"
                               placeholder="Arabic" value="{{ isset($item) ? $item->title_ar : old('title_ar') }}" required>

                        @error('title')
                            <div class="col invalid-feedback">{{ $message }}</div>
                        @enderror

                        @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="shortDescription">Short description</label>
                    <div class="input-group">
                        <textarea rows="5" name="short_description" id="shortDescription" class="form-control" placeholder="English">{{ isset($item) ? $item->short_description : old('short_description') }}</textarea>
                        <textarea rows="5" name="short_description_ar" id="shortDescriptionAr" class="form-control" placeholder="Arabic">{{ isset($item) ? $item->short_description_ar : old('short_description_ar') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <ul class="nav nav-tabs" id="bodyTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="bodyTab" data-toggle="tab" href="#body" role="tab" aria-controls="body" aria-selected="true">Body</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="bodyArTab" data-toggle="tab" href="#bodyAr" role="tab" aria-controls="bodyAr" aria-selected="false">Body ar</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="bodyContent">
                        <div class="tab-pane fade show active" id="body" role="tabpanel" aria-labelledby="bodyTab">
                            <textarea name="body" id="body" class="summernote @error('body') is-invalid @enderror" required></textarea>

                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="tab-pane fade" id="bodyAr" role="tabpanel" aria-labelledby="bodyArTab">
                            <textarea name="body_ar" id="bodyAr" class="summernote"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <p class="mb-1">Images</p>
                        @include('admin.includes._input-file', [
                            'name' => 'news_images[]',
                            'multiple' => true,
                            'formats' => '.jpg,.png,.tiff'
                        ])

                        @include('admin.includes._image_following_formats')
                    </div>
                    <div class="col-md-6">
                        <label for="newsDate">Created</label>
                        <input type="text" class="form-control datetimepicker-element-time" name="created_at" id="newsDate" required value="{{ \Carbon\Carbon::now()->format('Y-m-d h:m') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.news.index') ])
            </div>
        </div>
    </form>
@endsection
