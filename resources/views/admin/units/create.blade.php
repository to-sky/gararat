@extends('admin.layouts.master')

@section('title', 'Add unit')

@section('content')
    <form action="{{ route('admin.units.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <div class="card form-group rounded-0 border">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="equipment">Equipment</label>
                        <select name="equipment_id[]" id="equipment" multiple
                                class="select2-element @error('equipment_id') is-invalid @enderror">
                            @foreach($equipment as $equipmentItem)
                                <option value="{{ $equipmentItem->id }}"
                                @if (old('equipment_id') && in_array($equipmentItem->id, old('equipment_id')))
                                        selected
                                @endif>{{ $equipmentItem->name }}</option>
                            @endforeach
                        </select>

                        @error('equipment_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="catalog">Catalog</label>
                            <select name="catalog_id" id="catalog"
                                    class="form-control select2-element @error('catalog_id') is-invalid @enderror"
                                    data-placeholder="Select catalog">
                                <option></option>

                                @foreach($parentCatalogs as $parentCatalog)
                                    <optgroup label="{{ $parentCatalog->name }}">
                                        @foreach($parentCatalog->childs as $child)
                                            <option value="{{ $child->id }}"
                                                    @if (old('catalog_id') && $child->id == old('catalog_id'))
                                                        selected
                                                    @endif>
                                                {{ $child->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                            @error('catalog_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card form-group rounded-0 border">
            <div class="card-header border-0">
                <h5 class="mb-0">
                    <span>Parts</span>
                    <small id="partsCount" data-parts-count="0"
                           class="badge border text-muted float-right fsz-xs mt-1 mr-3 bg-light">0</small>
                </h5>
            </div>
            <div class="card-body pt-0 px-0">
                <div class="parts-content">
                    <table id="partsContent" class="table table-sm table-hover table-bordered">
                        <thead class="text-secondary">
                            <tr>
                                <th class="pl-4">#</th>
                                <th>Name</th>
                                <th>Producer ID</th>
                                <th width="20%">Qty in the unit</th>
                                <th width="8%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- insert content from modal --}}
                        </tbody>
                    </table>
                </div>

                @error('parts')
                    <div class="invalid-feedback d-b text-center">{{ $message }}</div>
                @enderror

                <div class="px-3">
                    <button type="button" data-action="add-part"
                            class="btn btn-outline-light btn-sm btn-block shadow-sm text-success border">
                        <i class="ti-plus"></i> Add parts
                    </button>
                </div>
            </div>
        </div>

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.units.index')
        ])
    </form>
@endsection

@push('scripts')
    @include('admin.units.includes._scripts')
@endpush
