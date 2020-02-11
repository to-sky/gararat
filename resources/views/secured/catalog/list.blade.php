@extends('layouts.secured')

@section('title') Catalog @endsection

@section('button')
    @include('includes.secured.elements._add-btn', ['href' => route('securedAddCatalogItemPage'), 'item' => 'Catalog'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                {!! $catalog !!}
            </div>
        </div>
    </div>
@endsection
