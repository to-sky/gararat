@extends('admin.layouts.master')

@section('title', "Edit equipment: $equipment->name")

@section('content')
    <form action="{{ route('admin.equipment.update', $equipment) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <ul class="nav nav-tabs border-bottom-0" id="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">Main</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="specification-tab" data-toggle="tab" href="#specification" role="tab" aria-controls="specification" aria-selected="false">Specifications</a>
            </li>
        </ul>

        <div class="tab-content mb-3" id="tabContent">
            <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                @component('admin.components.name', ['item' => $equipment])
                    @include('admin.equipment.includes._basic', ['item' => $equipment])
                @endcomponent
            </div>

            <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                @if ($equipment->specifications)
                    @include('admin.equipment.includes._specifications-edit', [
                        'specifications' => $equipment->specifications
                    ])
                @else
                    @include('admin.equipment.includes._specifications-create')
                @endif
            </div>
        </div>

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.equipment.index')
        ])
    </form>
@endsection

@push('scripts')
    @include('admin.equipment.includes._scripts')
@endpush
