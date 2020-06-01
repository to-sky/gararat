@extends('admin.layouts.master')

@section('title', "Edit news: $news->title")

@section('content')
    <form action="{{ route('admin.news.update', $news) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="card mb-3 rounded-0 border">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title*</label>
                            <div class="input-group">
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       placeholder="English" value="{{ $news->title ?? old('title') }}" required>

                                <input type="text" name="title_ar" class="form-control @error('title_ar') is-invalid @enderror"
                                       placeholder="Arabic" value="{{ $news->title_ar ?? old('title_ar') }}" required>

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @error('title_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shortDescription">Short description</label>
                            <div class="input-group">
                                <textarea rows="5" name="short_description" id="shortDescription" class="form-control" placeholder="English">{{ $news->short_description ?? old('short_description') }}</textarea>
                                <textarea rows="5" name="short_description_ar" id="shortDescriptionAr" class="form-control" placeholder="Arabic">{{ $news->short_description_ar ?? old('short_description_ar') }}</textarea>
                            </div>
                        </div>

                        <style>

                        </style>

                        <div class="form-group">
                            <div class="body__nav-container">
                                <ul class="nav nav-tabs" id="bodyTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="bodyTab" data-toggle="tab" href="#body" role="tab" aria-controls="body" aria-selected="true">Body</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="bodyArTab" data-toggle="tab" href="#bodyAr" role="tab" aria-controls="bodyAr" aria-selected="false">Body arabic</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="bodyContent">
                                    <div class="tab-pane fade show active" id="body" role="tabpanel" aria-labelledby="bodyTab">
                                        <textarea name="body" id="body" class="tinymce @error('body') is-invalid @enderror" required>{{ $news->body ?? old('body') }}</textarea>

                                        @error('body')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="tab-pane fade" id="bodyAr" role="tabpanel" aria-labelledby="bodyArTab">
                                        <textarea name="body_ar" id="bodyAr" class="tinymce">{{ $news->body_ar ?? old('body_ar') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-md-3">
                <div class="card mb-3 rounded-0 border">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="newsDate">Created</label>
                                <input type="text" class="form-control datetimepicker-element-time" name="created_at" id="newsDate" required value="{{ $news->created_at->toDateTimeString() }}">
                            </div>

                            <div class="col-12 form-group">
                                <p class="mb-1">Thumbnail</p>
                                @include('admin.includes._input-file', [
                                   'name' => 'thumbnail',
                                   'formats' => '.jpg,.png,.tiff'
                               ])

                                @include('admin.includes._image_following_formats')

                                <div class="d-flex justify-content-center">
                                    <div class="w-75">
                                        @if (isset($news) && $thumbnail = $news->getFirstMedia('thumbnail'))
                                            @include('admin.includes._form-image', [
                                                'mediaItem' => $thumbnail,
                                                'fullWidth' => true
                                            ])
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.news.index') ])
            </div>
        </div>
    </form>
@endsection
