@extends('admin.layouts.master')

@section('title', 'Slides')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.slides.create'), 'item' => 'Slide'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd pb-15">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>Number</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slides as $slide)
                            <tr>
                                <td>{{ $slide->slide_number }}</td>
                                <td>
                                    <img src="{{ asset($slide->getFirstMediaUrl('home_slide', 'thumb')) }}" height="26">
                                </td>
                                <td>{{ $slide->title }}</td>
                                <td>
                                    @if ($slide->link)
                                        <a href="{{ url($slide->link) }}" class="text-primary" target="_blank">{{ url($slide->link) }}</a>
                                    @endif
                                </td>

                                <td>
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.slides.edit', $slide)
                                            ])

                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.slides.destroy', $slide),
                                                'modalText' => 'slide "' . $slide->title . '"'
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

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'slide'])
@endsection
