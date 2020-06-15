@extends('admin.layouts.master')

@section('title', 'Add catalog')

@section('content')
    <form action="{{ route('admin.catalogs.store') }}" method="post" autocomplete="off">
        @csrf

        @component('admin.components.name')
            <div class="form-group">
                <label for="parentCatalog">Parent catalog</label>
                <select name="parent_id" id="parentCatalog"
                        class="form-control select2-element-clear"
                        data-placeholder="Select parent catalog">
                    {{--<option value="">Select parent catalog</option>--}}
                    <option></option>
                    @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}"
                                @if (old('parent_id')) selected @endif>
                            {{ $catalog->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endcomponent

        @include('admin.includes.blocks.save-or-back-btns', ['href' => route('admin.catalogs.index') ])
    </form>
@endsection
