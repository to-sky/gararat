@extends('admin.layouts.master')

@section('title', "Edit part: $part->name")

@section('content')
    <form action="{{ $part->path('update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="previous_page" value="{{ URL::previous() }}">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $part])
            @include('admin.parts.includes._basic', ['item' => $part])
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => URL::previous()
        ])
    </form>
@endsection
