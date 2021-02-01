@extends('admin.layouts.master')

@section('title', "Edit equipment group: $equipmentGroup->name")

@section('content')
    <form action="{{ route('admin.equipment-groups.update', $equipmentGroup) }}" method="post" autocomplete="off">
        <input type="hidden" name="previous_page" value="{{ URL::previous() }}">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $equipmentGroup])
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => URL::previous()
        ])
    </form>
@endsection
