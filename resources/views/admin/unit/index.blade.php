@extends('admin.layouts.master')

@section('title') Units @endsection

@section('button')
    @include('admin.includes._add-btn', [
        'href' => route('admin.unit.create'), 'item' => 'unit'
    ])
@endsection

@section('content')
    <div class="p-10 mb-3 border border shadow-sm">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="collapseUnits" @if($collapsedCards == 'hide') checked @endif>
            <label class="custom-control-label" for="collapseUnits">Collapse units</label>
        </div>
    </div>

    {{-- Render equipments --}}
    @foreach($equipmentUnits as $equipmentUnit)
        @php
            $equipment = $equipmentUnit->first()->equipment;
        @endphp

        <div class="card border mb-3 rounded-0 shadow-sm">
            <div class="card-header border-0">
                <div class="row">
                    <div class="col-md-10">
                        <h5 class="mb-0 text-danger">{{ $equipment->name }}</h5>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-sm text-primary pull-right"
                                type="button"
                                data-toggle="collapse" data-target="#equipment{{ $equipment->id }}"
                                aria-expanded="true" aria-controls="equipment{{ $equipment->id }}">
                            <i class="@if($collapsedCards == 'show') ti-arrow-circle-up @else ti-arrow-circle-down @endif"></i>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="list-group list-group-flush collapse border-top {{ $collapsedCards }}" id="equipment{{ $equipment->id }}">
                @foreach($equipmentUnit->groupBy('catalog.parent_id') as $units)
                <li class="list-group-item">
                    <span class="fw-500">{{ $units->first()->catalog->parent->name }}</span>

                    {{-- Render child catalogs --}}
                    <ul class="list-group">
                        @foreach ($units as $unit)
                        <li class="list-group-item">
                            <a href="{{ route('admin.unit.edit', $unit) }}" class="bnt btn-link">
                                - {{ $unit->catalog->name }}

                                <span class="badge badge-light badge-pill border ml-2 text-muted">{{ $unit->parts->count() }}</span>
                            </a>

                            <div class="pull-right">
                                    @include('admin.includes._delete-btn' , [
                                        'href' => route('admin.unit.destroy', $unit),
                                        'classes' => '',
                                        'modalText' => 'unit "' . $unit->catalog->name . ' on ' . $equipment->name . '"'
                                    ])
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    @endforeach

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'unit'])
@endsection

@push('scripts')
    <script>
        // Collapse units
        $('#collapseUnits').change(function (e) {
            let collapsedUnits = $('body').find('ul[id^="equipment"]');
            let collapseUnitsState = e.target.checked ? 'hide' : 'show';
            let collapseUnitsAction = collapsedUnits.first().hasClass('show') ? 'hide' : 'show';

            // Store to cache collapsed state
            $.get('{{ route('admin.unit.collapse-units-state') }}', {collapseState: collapseUnitsState});

            collapsedUnits.collapse(collapseUnitsAction);
        });

        // Get collapsed icon
        function getCollapsedIcon(el) {
            let targetId = $(el).attr('id');
            let targetBtn = $('[data-target="#' + targetId + '"]');

            return $(targetBtn).find('i');
        }

        // Collapsed events
        $(document).on('show.bs.collapse', 'ul[id^="equipment"]', function () {
            getCollapsedIcon(this).toggleClass('ti-arrow-circle-down ti-arrow-circle-up');
        }).on('hide.bs.collapse', 'ul[id^="equipment"]', function() {
            getCollapsedIcon(this).toggleClass('ti-arrow-circle-up ti-arrow-circle-down');
        });

    </script>
@endpush