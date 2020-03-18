@extends('admin.layouts.master')

@section('title') Edit: {{ $unit->catalog->name }} on {{ $unit->equipment->name }} @endsection

@section('content')
    <form action="{{ route('admin.unit.update', $unit) }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="col-md-12 card form-group rounded-0 border py-3">
            <div class="row">
                    @if ($figure = $unit->getFirstMedia('figure'))
                    <div class="ml-3">
                        @include('admin.includes._form-image', [
                            'mediaItem' => $figure,
                            'class' => 'm-0 shadow-none'
                        ])
                    </div>
                    @endif
                <div class="col">
                    <p class="mb-1">Figure</p>
                    @include('admin.includes._input-file', [
                        'name' => 'figure',
                        'placeholder' => 'Select image'
                    ])
                    <small class="text-muted">
                        The following file formats are supported:
                        <span class="badge border p-3">jpg</span>
                        <span class="badge border p-3">png</span>
                        <span class="badge border p-3">tiff</span>
                    </small>
                </div>
            </div>
        </div>

        <div class="card form-group rounded-0 border">
            <div class="card-header border-0">
                <h5 class="mb-0">
                    <span>Parts</span>
                    <small id="partsCount" data-parts-count="{{ $unit->unitParts->count() }}"
                            class="badge border text-muted pull-right fsz-xs mt-1 mr-3 bg-light"
                    >{{ $unit->unitParts->count() }}</small>
                </h5>
            </div>
            <div class="card-body pt-0 px-0">
                <div class="parts-content">
                    <table id="partsContent" class="table table-sm table-hover">
                        <thead class="text-muted">
                            <tr>
                                <th class="pl-4">#</th>
                                <th>Name</th>
                                <th>Producer ID</th>
                                <th width="20%">Qty in the unit</th>
                                <th width="8%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($unit->unitParts->sortBy('part_id') as $key => $unitPart)
                            <tr>
                                <td class="pl-4">{{ $unitPart->part->id }}</td>
                                <td>{{ $unitPart->part->name }}</td>
                                <td>{{ $unitPart->part->producer_id }}</td>
                                <td>
                                    <input type="number" min="0" step="1"
                                           class="form-control form-control-sm"
                                           name="parts[{{ $loop->index }}][qty]" value="{{ $unitPart->qty }}"/>
                                    <input type="hidden"
                                           name="parts[{{ $loop->index }}][part_id]" value="{{ $unitPart->part->id }}" />
                                </td>
                                <td class="text-center" data-row="actions">
                                    <button type="button" class="btn ml-1 px-1 py-0 py-1 text-danger delete-part" title="Delete part">
                                        <i class="ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @error('parts')
                    <div class="invalid-feedback d-b text-center mb-3 fsz-sm">You can't delete all parts. If you want to do that please delete this unit.</div>
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
            'href' => route('admin.unit.index')
        ])
    </form>
@endsection

@push('scripts')
    @include('admin.unit.includes._scripts')
@endpush
