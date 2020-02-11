@extends('layouts.secured')

@section('title') Slider @endsection

@include('includes.secured.modals._deleteItem', ['item' => 'slide'])

@section('button')
    @include('includes.secured.elements._add-btn', ['href' => route('admin.slider.create'), 'item' => 'Slide'])
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
                                            @include('includes.secured.elements._edit-btn' , [
                                                'href' => route('admin.slider.edit', $slide->sl_id)
                                            ])

                                            @include('includes.secured.elements._delete-btn' , [
                                                'href' => route('admin.slider.delete', ['slider' => $slide->sl_id]),
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
@endsection
