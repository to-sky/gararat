@extends('layouts.secured')

@section('title') News @endsection

@include('includes.secured.modals._deleteItem', ['item' => 'news'])

@section('button')
    @include('includes.secured.elements._add-btn', ['href' => route('admin.news.create'), 'item' => 'News'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd pb-15">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th class="text-right">Action</th>
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
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('includes.secured.elements._edit-btn' , [
                                            'href' => route('admin.news.edit', $item->nw_id)
                                        ])

                                        @include('includes.secured.elements._delete-btn' , [
                                            'href' => route('admin.news.delete', ['news' => $item->nw_id]),
                                            'modalText' => 'news "' . $item->nw_name . '"'
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-20 pull-right">
                {{ $news->links() }}
            </div>
        </div>
    </div>
@endsection
