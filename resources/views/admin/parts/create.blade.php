@extends('admin.layouts.master')

@section('title', 'Add part')

@section('content')
    <form action="{{ route('admin.parts.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        @component('admin.components.name')
            @include('admin.parts.includes._basic')
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.parts.index')
        ])
    </form>
@endsection