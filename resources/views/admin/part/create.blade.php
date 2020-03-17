@extends('admin.layouts.master')

@section('title') Add part @endsection

@section('content')
    <form action="{{ route('admin.part.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        @component('admin.components.name')
            @include('admin.part.includes._basic')
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.part.index')
        ])
    </form>
@endsection