@extends('admin.layouts.master')

@section('title', 'Add page')

@section('content')
    <form action="{{ route('admin.pages.store') }}" method="post" autocomplete="off">
        @csrf

        @component('admin.components.name')
            <div class="form-group">
                <label for="title">Title</label>
                <div class="input-group">
                    <input type="text" name="title"
                           class="form-control"
                           placeholder="English" value="{{ old('title') }}">

                    <input type="text" name="title_ar" class="form-control"
                           placeholder="Arabic" value="{{ old('title_ar') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="body__nav-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="bodyTab" data-toggle="tab" href="#body" role="tab" aria-controls="body" aria-selected="true">Body</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="bodyArTab" data-toggle="tab" href="#bodyAr" role="tab" aria-controls="bodyAr" aria-selected="false">Body arabic</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="bodyContent">
                        <div class="tab-pane fade show active" id="body" role="tabpanel" aria-labelledby="bodyTab">
                            <textarea name="body" id="body" rows="8" class="tinymce">{{ old('body') }}</textarea>
                        </div>
                        <div class="tab-pane fade" id="bodyAr" role="tabpanel" aria-labelledby="bodyArTab">
                            <textarea name="body_ar" id="bodyAr" class="tinymce">{{ old('body_ar') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.pages.index') ])
    </form>
@endsection
