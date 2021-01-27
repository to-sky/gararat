@extends('admin.layouts.master')

@section('title', "Edit page: $page->name")

@section('content')
    <form action="{{ route('admin.pages.update', $page) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $page, 'hidden' => $page->isHome()])
            @if($page->isHome())
                <input type="hidden" name="name" value="{{ $page->name }}">
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <div class="input-group">
                    <input type="text" name="title"
                           class="form-control"
                           placeholder="English" value="{{ $page->title ?? old('title') }}">

                    <input type="text" name="title_ar" class="form-control"
                           placeholder="Arabic" value="{{ $page->title_ar ?? old('title_ar') }}">
                </div>
            </div>

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
                            <textarea name="body" id="body" rows="8" class="tinymce">{!! $page->body ?? old('body') !!}</textarea>
                        </div>
                        <div class="tab-pane fade" id="bodyAr" role="tabpanel" aria-labelledby="bodyArTab">
                            <textarea name="body_ar" id="bodyAr" class="tinymce">{!! $page->body_ar ?? old('body_ar') !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endcomponent

        <div class="row mt-3">
            <div class="col-md-12">
                @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.pages.index') ])
            </div>
        </div>
    </form>
@endsection
