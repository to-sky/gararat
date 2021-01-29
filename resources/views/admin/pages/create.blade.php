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
                @include('admin.includes._body')
            </div>
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.pages.index') ])
    </form>
@endsection
