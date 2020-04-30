@extends('admin.layouts.master')

@section('title', 'News')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.news.create'), 'item' => 'news'])
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
                            <td>{{ $item->id }}</td>
                            <td>
                                <img src="{{ asset($item->getFirstMediaUrl('news_images', 'thumb')) }}" height="50">
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->created_at->toDateString() }}</td>
                            <td>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._show-btn' , [
                                           'href' => route('news.show', $item)
                                       ])

                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.news.edit', $item)
                                        ])

                                        @include('admin.includes._delete-btn' , [
                                            'href' => route('admin.news.destroy', ['news' => $item]),
                                            'modalText' => 'news "' . $item->title . '"'
                                        ])
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-2 float-right">
                {{ $news->links() }}
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'news'])
@endsection
