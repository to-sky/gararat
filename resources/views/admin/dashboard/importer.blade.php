@extends('admin.layouts.master')

@section('title', 'Importer')

@section('content')
    <div class="row">
        {{-- Export --}}
        <div class="col-md-5">
            <div class="card border mb-3 rounded-0 shadow-sm">
                <div class="bg-white card-header">
                    <h5 class="mb-0">Export</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.importer.export') }}">
                        <div class="row">
                            <div class="col-md-10 pt-2">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="exportEquipment" name="export_type" value="equipment" required
                                           class="custom-control-input form-control @error('export_type') is-invalid @enderror">
                                    <label class="custom-control-label" for="exportEquipment">Equipment</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="exportParts" name="export_type" value="parts" required
                                           class="custom-control-input form-control @error('export_type') is-invalid @enderror">
                                    <label class="custom-control-label" for="exportParts">Parts</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-outline-success pull-right" type="submit" id="exportBtn">
                                    <i class="fas fa-file-excel"></i>
                                </button>
                            </div>

                            @error('export_type')
                            <div class="col">
                                <div class="d-b invalid-feedback pt-2">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Import --}}
        <div class="col-md-7">
            <div class="card border mb-3 rounded-0 shadow-sm">
                <div class="bg-white card-header">
                    <h5 class="mb-0">Import</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.importer.import') }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-md-5 pt-2">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="importEquipment" name="import_type" value="equipment" required
                                           class="custom-control-input form-control @error('import_type') is-invalid @enderror">
                                    <label class="custom-control-label" for="importEquipment">Equipment</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="importParts" name="import_type" value="parts" required
                                           class="custom-control-input form-control @error('import_type') is-invalid @enderror">
                                    <label class="custom-control-label" for="importParts">Parts</label>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('import_file') is-invalid @enderror" required
                                               name="import_file" id="importFile" accept=".xlsx" aria-describedby="importBtn" >
                                        <label class="custom-file-label" for="importFile">Select .xlsx</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" type="submit" id="importBtn">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @error('import_type')
                                <div class="col">
                                    <div class="d-b invalid-feedback pl-3 w-50">{{ $message }}</div>
                                </div>
                                @enderror

                                @error('import_file')
                                <div class="col">
                                    <div class="d-b invalid-feedback pr-3 w-50">
                                        <span class="pull-right">{{ $message }}</span>
                                    </div>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
