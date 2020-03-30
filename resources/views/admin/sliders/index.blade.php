@extends('admin.layouts.master')

@section('title', 'Sliders')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.sliders.create'), 'item' => 'Slide'])
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
                            <th>Link</th>
                            <th class="text-right">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slides as $slide)
                            <tr>
                                <td>{{ $slide->sl_order }}</td>
                                <td><img src="{{ asset($slide->sl_image) }}" alt="{{ $slide->sl_title }}" height="26"></td>
                                <td>{{ $slide->sl_title }}</td>
                                @if($slide->sl_description && $slide->sl_description !== null)
                                    <td><a href="{{ $slide->sl_description }}" target="_blank" class="btn btn-link">Go to linked page</a></td>
                                @else
                                    <td>{{ $slide->sl_description }}</td>
                                @endif
                                <td>
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.sliders.edit', $slide)
                                            ])

                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.sliders.destroy', ['slider' => $slide]),
                                                'modalText' => 'slide "' . $slide->sl_title . '"'
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
