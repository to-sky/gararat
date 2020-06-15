@extends('admin.layouts.master')

@section('title', 'Add equipment group')

@section('content')
    <form action="{{ route('admin.equipment-groups.store') }}" method="post" autocomplete="off">
        @csrf

        @component('admin.components.name')
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.equipment-groups.index') ]
        )
    </form>
@endsection
