@extends('layouts.secured')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($slides as $slide)
                            <tr>
                                <td>{{ $slide->sl_order }}</td>
                                <td><img src="{{ asset($slide->sl_image) }}" alt="{{ $slide->sl_title }}" height="26"></td>
                                <td>{{ $slide->sl_title }}</td>
                                @if($slide->sl_description && $slide->sl_description !== null)
                                    <td><a href="{{ $slide->sl_description }}" target="_blank">Go to linked page</a></td>
                                @else
                                    <td>{{ $slide->sl_description }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('securedEditSlidePage', $slide->sl_id) }}" class="btn btn-success"><i class="ti-pencil"></i></a>
                                    <a href="{{ route('securedRemoveSlide', $slide->sl_id) }}" class="btn btn-danger"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
