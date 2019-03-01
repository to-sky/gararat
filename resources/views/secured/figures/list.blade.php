@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Figure Number</th>
                            <th>Catalog</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($figures as $figure)
                            <tr>
                                <td>{{ $figure->fig_id }}</td>
                                <td>{{ $figure->fig_no }}</td>
                                <td>{{ $figure->cat_number }} - {{ $figure->cat_name_en }}</td>
                                <td>
                                    <a href="{{ route('createNewConstructorDrawingPage', $figure->fig_id) }}" class="btn btn-success"><i class="ti-pencil"></i></a>
                                    <a href="" class="btn btn-danger"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
