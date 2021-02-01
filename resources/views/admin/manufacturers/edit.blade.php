@extends('admin.layouts.master')

@section('title', "Edit manufacturer: $manufacturer->name")

@section('content')
    <form action="{{ route('admin.manufacturers.update', $manufacturer) }}" method="post" autocomplete="off">
        <input type="hidden" name="previous_page" value="{{ URL::previous() }}">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $manufacturer]) @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => URL::previous()
        ])
    </form>
@endsection
