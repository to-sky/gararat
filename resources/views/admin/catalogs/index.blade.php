@extends('admin.layouts.master')

@section('title', 'Catalogs')

@section('button')
    @include('admin.includes._add-btn', ['href' => route('admin.catalogs.create'), 'item' => 'Catalog'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                <table class="table table-borderless table-hover table-striped">
                    <thead class="shadow-sm">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($catalogs as $catalog)
                        <tr>
                            <td>{{ $catalog->id }}</td>
                            <td width="45%">
                                @if ($catalog->isParent())
                                    <b>{{ $catalog->name }}</b>
                                @else
                                    - {{ $catalog->name }}
                                @endif
                            </td>
                            <td>
                                <div class="pull-right">
                                    <div class="btn-group btn-group-sm shadow-sm" role="group">
                                        @include('admin.includes._edit-btn' , [
                                            'href' => route('admin.catalogs.edit', compact('catalog'))
                                        ])

                                        @if (! $catalog->hasChilds())
                                            @include('admin.includes._delete-btn' , [
                                                'href' => route('admin.catalogs.destroy', $catalog),
                                                'modalText' => 'product "' . $catalog->name . '"'
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

            <div class="mt-2 pull-right">
                {{ $catalogs->links() }}
            </div>
        </div>
    </div>

    @include('admin.includes.blocks.delete-item-modal', ['item' => 'catalog'])
@endsection
