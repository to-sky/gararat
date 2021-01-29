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
                @include('admin.includes._body', ['item' => $page])
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
