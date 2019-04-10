@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Home Page</td>
                        <td><a href="{{ route('securedHomePageEditPage') }}" class="btn btn-success"><i class="ti-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Services Page</td>
                        <td><a href="{{ route('securedServicesPageEditPage') }}" class="btn btn-success"><i class="ti-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Contacts Page</td>
                        <td><a href="{{ route('securedContactsPageEditPage') }}" class="btn btn-success"><i class="ti-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Parts Pages</td>
                        <td><a href="{{ route('securedCatalogPageEditPage', 'parts') }}" class="btn btn-success"><i class="ti-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Equipment Pages</td>
                        <td><a href="{{ route('securedCatalogPageEditPage', 'equipment') }}" class="btn btn-success"><i class="ti-pencil"></i></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
