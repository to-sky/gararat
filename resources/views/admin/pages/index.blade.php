@extends('admin.layouts.master')

@section('title', 'Pages')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>Name</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->name }}</td>
                                <td>
                                    <div class="float-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.pages.edit', $page)
                                            ])

                                            @include('admin.includes._show-btn' , [
                                               'href' => route($page->slug)
                                            ])
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
