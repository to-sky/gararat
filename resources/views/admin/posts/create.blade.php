@extends('admin.layouts.master')

@section('title', 'Add post')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
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
                                       placeholder="English" value="{{ old('title') }}" required>

                                <input type="text" name="title_ar" class="form-control @error('title_ar') is-invalid @enderror"
                                       placeholder="Arabic" value="{{ old('title_ar') }}" required>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @error('title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="shortDescription">Short description</label>
                            <div class="input-group">
                                <textarea rows="5" name="short_description" id="shortDescription" class="form-control" placeholder="English">{{ old('short_description') }}</textarea>
                                <textarea rows="5" name="short_description_ar" id="shortDescriptionAr" class="form-control" placeholder="Arabic">{{ old('short_description_ar') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            @include('admin.includes._body')
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
                                <label for="createdDate">Created</label>
                                <input type="text" class="form-control datetimepicker-element-time" name="created_at" id="createdDate" required value="{{ \Carbon\Carbon::now()->format('Y-m-d h:m') }}">
                            </div>

                            <div class="col-12 form-group">
                                <label for="postStatus">Status</label>
                                <select name="is_published" id="postStatus" class="form-control">
                                    <option value="1">Published</option>
                                    <option value="0">Druft</option>
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <label for="postType">Post type</label>
                                <select name="type" id="postType" class="form-control">
                                    @foreach (App\Models\Post::getTypes() as $key => $postTypeName)
                                        <option value="{{ $key }}">{{ $postTypeName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <p class="mb-1">Thumbnail</p>
                                @include('admin.includes._input-file', [
                                    'name' => 'thumbnail',
                                    'formats' => '.jpg,.png,.tiff'
                                ])

                                @include('admin.includes._image_following_formats')
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.includes.blocks.save-or-back-btns', [
                    'href' => URL::previous()
                ])
            </div>
        </div>
    </form>
@endsection
