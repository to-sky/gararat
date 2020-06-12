@extends('admin.layouts.master')

@section('title', 'Pages')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.pages.create'), 'item' => 'page'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>Name</th>
                            <th>Link</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->name }}</td>
                                <td>
                                    <a href="{{ $page->getUrl() }}" target="_blank" class="p-0 btn btn-link">{{ $page->getUrl() }}</a>
                                </td>
                                <td>
                                    <div class="float-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.pages.edit', $page)
                                            ])

                                            @if(! $page->isHome())
                                                @include('admin.includes._delete-btn' , [
                                                   'href' => route('admin.pages.destroy', $page),
                                                   'modalText' => 'page "' . $page->name . '"'
                                                ])
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-2 float-right">
                {{ $pages->links() }}
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'page'])
@endsection
