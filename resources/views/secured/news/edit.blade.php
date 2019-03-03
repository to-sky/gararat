@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <form action="{{ route('updateNewsItemAPI') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="nw_id" value="{{ $news->nw_id }}">
                    <div class="form-group">
                        <label for="newsName">Name</label>
                        <input type="text" class="form-control" name="newsName" id="newsName" required value="{{ $news->nw_name }}">
                    </div>
                    <div class="form-group">
                        <label for="newsBody">Body</label>
                        <textarea name="newsBody" id="newsBody" class="summernote">{{ $news->nw_body }}</textarea>
                    </div>
                    <div class="form-group">
                        <p><img src="{{ asset($news->nw_image) }}" height="48" alt=""></p>
                        <label for="newsImage">Upload Figure Image (Leave empty to keep previous image)</label>
                        <input type="file" class="form-control-file" name="newsImage" id="newsImage">
                    </div>
                    <div class="form-group">
                        <label for="newsTitle">Title</label>
                        <input type="text" class="form-control" name="newsTitle" id="newsTitle" required value="{{ $news->nw_title }}">
                    </div>
                    <div class="form-group">
                        <label for="newsDescription">SEO Description</label>
                        <textarea name="newsDescription" id="newsDescription" class="form-control">{{ $news->nw_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
