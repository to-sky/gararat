@extends('admin.layouts.master')

@section('title', 'Posts')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.posts.create'), 'item' => 'post'])
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
                        <th>Type</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>
                                <img src="{{ asset($post->getFirstMediaUrl('thumbnail', 'thumb')) }}" height="50">
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->displayType() }}</td>
                            <td>{{ $post->displayStatus() }}</td>
                            <td>{{ $post->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._show-btn' , [
                                           'href' => route('posts.show', $post)
                                       ])

                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.posts.edit', $post)
                                        ])

                                        @include('admin.includes._delete-btn' , [
                                            'href' => route('admin.posts.destroy', $post),
                                            'modalText' => 'post "' . $post->title . '"'
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
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'post'])
@endsection
