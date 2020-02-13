@extends('layouts.secured')

@section('title') Edit news: {{ $news->nw_name }} @endsection

@section('content')
    <form action="{{ route('updateNewsItemAPI') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <input type="hidden" name="nw_id" value="{{ $news->nw_id }}">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsName">Name</label>
                            <input type="text" class="form-control" name="newsName" id="newsName" required value="{{ $news->nw_name }}">
                        </div>
                        <div class="col-6">
                            <label for="newsNameAr">Name Ar.</label>
                            <input type="text" class="form-control" name="newsNameAr" id="newsNameAr" required value="{{ $news->nw_name_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsBody">Body</label>
                            <textarea name="newsBody" id="newsBody" class="summernote">{{ $news->nw_body }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="newsBodyAr">Body Ar.</label>
                            <textarea name="newsBodyAr" id="newsBodyAr" class="summernote">{{ $news->nw_body_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsTitle">Title</label>
                            <input type="text" class="form-control" name="newsTitle" id="newsTitle" required value="{{ $news->nw_title }}">
                        </div>
                        <div class="col-6">
                            <label for="newsTitleAr">Title Ar.</label>
                            <input type="text" class="form-control" name="newsTitleAr" id="newsTitleAr" required value="{{ $news->nw_title_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsDescription">SEO Description</label>
                            <textarea name="newsDescription" id="newsDescription" class="form-control">{{ $news->nw_description }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="newsDescriptionAr">SEO Description Ar.</label>
                            <textarea name="newsDescriptionAr" id="newsDescriptionAr" class="form-control">{{ $news->nw_description_ar }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white p-20 bd mt-3">
                    <div class="form-group row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($news->nw_image) }}" class="img-fluid mt-2" alt="{{ $news->nw_name }}">
                                </div>
                                <div class="col-md-10">
                                    <p class="mb-1">Upload News Image (Leave empty to keep previous image)</p>

                                    @include('includes.secured.elements._input-file', [
                                        'name' => 'newsImage',
                                        'placeholder' => $news->nw_image
                                    ])
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="newsDate">Created</label>
                            <input type="text" class="form-control datetimepicker-element-time" name="newsDate" id="newsDate" required value="{{ \Carbon\Carbon::parse($news->nw_created)->format('Y-m-d h:m') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('includes.secured.elements._save_or_back_btns', ['href' => route('admin.news.index') ])
            </div>
        </div>
    </form>
@endsection
