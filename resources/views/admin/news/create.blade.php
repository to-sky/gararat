@extends('admin.layouts.master')

@section('title') Add news @endsection

@section('content')
    <form action="{{ route('saveNewNewsItemAPI') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-12">
                <div class="bgc-white p-20 bd">
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsName">Name</label>
                            <input type="text" class="form-control" name="newsName" id="newsName" required>
                        </div>
                        <div class="col-6">
                            <label for="newsNameAr">Name Ar.</label>
                            <input type="text" class="form-control" name="newsNameAr" id="newsNameAr" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsBody">Body</label>
                            <textarea name="newsBody" id="newsBody" class="summernote"></textarea>
                        </div>
                        <div class="col-6">
                            <label for="newsBodyAr">Body Ar.</label>
                            <textarea name="newsBodyAr" id="newsBodyAr" class="summernote"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsTitle">Title</label>
                            <input type="text" class="form-control" name="newsTitle" id="newsTitle" required>
                        </div>
                        <div class="col-6">
                            <label for="newsTitleAr">Title Ar.</label>
                            <input type="text" class="form-control" name="newsTitleAr" id="newsTitleAr" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="newsDescription">Preview and Description</label>
                            <textarea name="newsDescription" id="newsDescription" class="form-control"></textarea>
                        </div>
                        <div class="col-6">
                            <label for="newsDescriptionAr">Preview and Description Ar.</label>
                            <textarea name="newsDescriptionAr" id="newsDescriptionAr" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white p-20 bd mt-3">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <p class="mb-1">Upload news image</p>
                            @include('admin.includes._input-file', [
                                'name' => 'newsImage',
                                'required' => 'true'
                            ])
                        </div>
                        <div class="col-md-6">
                            <label for="newsDate">Created</label>
                            <input type="text" class="form-control datetimepicker-element-time" name="newsDate" id="newsDate" required value="{{ \Carbon\Carbon::now()->format('Y-m-d h:m') }}">
                        </div>
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
