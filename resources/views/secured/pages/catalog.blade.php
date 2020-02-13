@extends('layouts.secured')

@section('title') Edit page: {{ $title }} @endsection

@section('content')
    <form action="{{ route('updatePageItemAPI') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <input type="hidden" name="pageId" value="{{ $pageData->pg_id }}">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="pageName">Name</label>
                            <input type="text" class="form-control" name="pageName" id="pageName" required value="{{ $pageData->pg_name }}">
                        </div>
                        <div class="col-6">
                            <label for="pageNameAr">Name Ar.</label>
                            <input type="text" class="form-control" name="pageNameAr" id="pageNameAr" required value="{{ $pageData->pg_name_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="pageBody">Body</label>
                            <textarea name="pageBody" id="pageBody" class="summernote">{{ $pageData->pg_body }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="pageBodyAr">Body Ar.</label>
                            <textarea name="pageBodyAr" id="pageBodyAr" class="summernote">{{ $pageData->pg_body_ar }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="pageTitle">Title</label>
                            <input type="text" class="form-control" name="pageTitle" id="pageTitle" required value="{{ $pageData->pg_title }}">
                        </div>
                        <div class="col-6">
                            <label for="pageTitleAr">Title Ar.</label>
                            <input type="text" class="form-control" name="pageTitleAr" id="pageTitleAr" required value="{{ $pageData->pg_title_ar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="pageDescription">SEO Description</label>
                            <textarea name="pageDescription" id="pageDescription" class="form-control">{{ $pageData->pg_description }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="pageDescriptionAr">SEO Description Ar.</label>
                            <textarea name="pageDescriptionAr" id="pageDescriptionAr" class="form-control">{{ $pageData->pg_description_ar }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                @include('includes.secured.elements._save_or_back_btns', ['href' => route('admin.pages.index') ])
            </div>
        </div>
    </form>
@endsection