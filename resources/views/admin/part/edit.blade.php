@extends('admin.layouts.master')

@section('title') Edit part: {{ $part->name }} @endsection

@section('content')
    <form action="{{ route('admin.part.update', $part) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $part])
            @include('admin.part.includes._basic', ['item' => $part])
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.part.index')
        ])
    </form>
@endsection