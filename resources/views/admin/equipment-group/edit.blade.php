@extends('admin.layouts.master')

@section('title') Edit equipment group: {{ $equipmentGroup->name }} @endsection

@section('content')
    <form action="{{ route('admin.equipment-group.update', $equipmentGroup) }}" method="post" autocomplete="off">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $equipmentGroup])
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.equipment-group.index')
        ])
    </form>
@endsection
