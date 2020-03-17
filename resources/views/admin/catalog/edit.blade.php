@extends('admin.layouts.master')

@section('title') Edit catalog: {{ $catalog->name }} @endsection

@section('content')
    <form action="{{ route('admin.catalog.update', $catalog) }}" method="post" autocomplete="off">
        @method('PUT')
        @csrf

        @component('admin.components.name', ['item' => $catalog])
            <div class="form-group">
                <label for="parentCatalog">Parent catalog</label>
                <select name="parent_id" id="parentCatalog"
                        class="form-control select2-element-clear"
                        data-placeholder="Select parent catalog">
                    <option></option>
                    @foreach($catalogs as $catalogItem)
                        @if ($catalogItem->id == $catalog->id)
                            @continue
                        @endif

                        <option value="{{ $catalogItem->id }}"
                            @if($catalogItem->id == $catalog->parent_id
                                || old('parent_id') == $catalog->id) selected
                            @endif>
                            {{ $catalogItem->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', [
            'href' => route('admin.catalog.index')
        ])
    </form>
@endsection
