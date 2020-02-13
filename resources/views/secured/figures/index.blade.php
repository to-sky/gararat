@extends('layouts.secured')

@section('title') Figures @endsection

@include('includes.secured.modals._deleteItem', ['item' => 'figure'])

@section('button')
    @include('includes.secured.elements._add-btn', ['href' => route('admin.figures.create'), 'item' => 'figure'])
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
                                    <div class="pull-right">
                                        <div class="btn-group btn-group-sm shadow-sm" role="group">
                                            @include('includes.secured.elements._edit-btn' , [
                                                'href' => route('admin.figures.constructor.create', $figure->fig_id)
                                            ])

                                            @include('includes.secured.elements._delete-btn' , [
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

            <div class="mt-20 pull-right">
                {{ $figures->links() }}
            </div>
        </div>
    </div>
@endsection
