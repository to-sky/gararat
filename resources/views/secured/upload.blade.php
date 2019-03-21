@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-6">
            <form action="{{ route('uploadEquipmentsCsvApi') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Upload <strong>Equipments</strong> CSV</h6>
                    <div class="form-group">
                        <label for="uploadEQFile">Add CSV file with Equipments</label>
                        <input type="file" name="uploadEQFile" id="uploadEQFile" required class="form-control-file">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save Equipments CSV</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <form action="{{ route('uploadPartsCsvApi') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="bgc-white p-20 bd">
                    <h6 class="c-grey-900">Upload <strong>Parts</strong> CSV</h6>
                    <div class="form-group">
                        <label for="uploadPFile">Add CSV file with Parts</label>
                        <input type="file" name="uploadPFile" id="uploadPFile" required class="form-control-file">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save Parts CSV</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
