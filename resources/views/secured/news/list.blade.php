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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $item)
                        <tr>
                            <td>{{ $item->nw_id }}</td>
                            <td><img src="{{ asset($item->nw_image) }}" height="28" alt=""></td>
                            <td>{{ $item->nw_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->nw_created)->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('securedUpdateNewsItem', $item->nw_id) }}" class="btn btn-success"><i class="ti-pencil"></i></a>
                                <a href="{{ route('securedRemoveNewsItem', $item->nw_id) }}" class="btn btn-danger"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $news->links() }}
@endsection
