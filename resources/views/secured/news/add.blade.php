@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <form action="{{ route('saveNewNewsItemAPI') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                            <label for="newsDate">Created At</label>
                            <input type="text" class="form-control" name="newsDate" id="newsDate" required value="{{ \Carbon\Carbon::now()->format('Y-m-d h:m') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="newsBody">Body</label>
                            <textarea name="newsBody" id="newsBody" class="summernote"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="newsBodyAr">Body Ar.</label>
                            <textarea name="newsBodyAr" id="newsBodyAr" class="summernote"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="newsImage">Upload News Image</label>
                            <input type="file" class="form-control-file" name="newsImage" id="newsImage" required>
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
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
