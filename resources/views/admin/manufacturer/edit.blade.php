@extends('admin.layouts.master')

@section('title') Edit manufacturer: {{ $manufacturer->name }} @endsection

@section('content')
    <form action="{{ route('admin.manufacturer.update', $manufacturer) }}" method="post" autocomplete="off">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $manufacturer]) @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.manufacturer.index')
        ])
    </form>
@endsection
