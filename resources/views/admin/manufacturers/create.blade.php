@extends('admin.layouts.master')

@section('title', 'Add manufacturer')

@section('content')
    <form action="{{ route('admin.manufacturers.store') }}" method="post" autocomplete="off">
        @csrf

        @component('admin.components.name') @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => URL::previous()
        ])
    </form>
@endsection
