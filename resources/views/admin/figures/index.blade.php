@extends('admin.layouts.master')

@section('title') Figures @endsection

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.figures.create'), 'item' => 'figure'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                        <tr>
                            <th>#</th>
                            <th>Figure Number</th>
                            <th>Catalog</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($figures as $figure)
                            <tr>
                                <td>{{ $figure->fig_id }}</td>
                                <td>{{ $figure->fig_no }}</td>
                                <td>{{ $figure->catalog()->first()->displayCatalogName() }}</td>
                                <td>
                                    <div class="float-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('admin.includes._edit-btn' , [
                                                'href' => route('admin.figures.constructor.create', $figure->fig_id)
                                            ])

                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.figures.delete', ['figure' => $figure->fig_id, 'catalog' => $figure->cat_number]),
                                                'modalText' => 'figure "' . $figure->fig_id . '"'
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
                @if($figures->isNotEmpty())
                    {{ $figures->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'figure'])
@endsection
