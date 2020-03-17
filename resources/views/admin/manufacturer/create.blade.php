@extends('admin.layouts.master')

@section('title') Add manufacturer @endsection

@section('content')
    <form action="{{ route('admin.manufacturer.store') }}" method="post" autocomplete="off">
        @csrf

        @component('admin.components.name') @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.manufacturer.index') ]
        )
    </form>
@endsection
