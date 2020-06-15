@extends('admin.layouts.master')

@section('title', "Edit part: $part->name")

@section('content')
    <form action="{{ $part->path('update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $part])
            @include('admin.parts.includes._basic', ['item' => $part])
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.parts.index')
        ])
    </form>
@endsection