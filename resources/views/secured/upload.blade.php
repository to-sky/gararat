@extends('layouts.secured')

@section('title') Upload CSV @endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <form action="{{ route('uploadEquipmentsCsvApi') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Equipments</h6>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                @include('includes.secured.elements._input-file', [
                                    'name' => 'uploadEQFile',
                                    'label' => 'Select CSV',
                                    'required' => 'true'
                                ])
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-6">
            <form action="{{ route('uploadPartsCsvApi') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Parts</h6>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                @include('includes.secured.elements._input-file', [
                                    'name' => 'uploadPFile',
                                    'label' => 'Select CSV',
                                    'required' => 'true'
                                ])
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
