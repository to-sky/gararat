@extends('admin.layouts.master')

@section('title') Add equipment group @endsection

@section('content')
    <form action="{{ route('admin.equipment-group.store') }}" method="post" autocomplete="off">
        @csrf

        @component('admin.components.name')
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.equipment-group.index') ]
        )
    </form>
@endsection
