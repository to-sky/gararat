@extends('admin.layouts.master')

@section('title') Parts @endsection

@section('button')
    @include('admin.includes._add-btn', [
        'href' => route('admin.part.create'), 'item' => 'part'
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Producer ID</th>
                            <th>Qty</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parts as $part)
                            <tr style="line-height: 41px;">
                                <td>{{ $part->id }}</td>
                                <td>
                                    <img src="{{ asset($part->getFirstMediaUrl('main_image', 'thumb')) }}" width="50">
                                </td>
                                <td width="45%">{{ $part->name }}</td>
                                <td>EGP {!! $part->displayPrice() !!}</td>
                                <td>{{ $part->producer_id }}</td>
                                <td>{{ $part->qty }}</td>
                                <td>
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.part.edit', $part)
                                            ])

                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.part.destroy', $part),
                                                'modalText' => 'part "' . $part->name . '"'
                                            ])
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-2 pull-right">
                @if($parts->isNotEmpty())
                    {{ $parts->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'part'])
@endsection
