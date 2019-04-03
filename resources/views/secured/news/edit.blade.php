@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <form action="{{ route('updateNewsItemAPI') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        <div class="col-12">
                            <label for="newsBody">Body</label>
                            <textarea name="newsBody" id="newsBody" class="summernote">{{ $news->nw_body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="newsBodyAr">Body Ar.</label>
                            <textarea name="newsBodyAr" id="newsBodyAr" class="summernote">{{ $news->nw_body_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <p><img src="{{ asset($news->nw_image) }}" height="48" alt=""></p>
                            <label for="newsImage">Upload News Image (Leave empty to keep previous image)</label>
                            <input type="file" class="form-control-file" name="newsImage" id="newsImage">
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
                    <div class="form-group row">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
