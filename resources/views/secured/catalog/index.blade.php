@extends('layouts.secured')

@section('title') Catalog @endsection

@section('button')
    @include('includes.secured.elements._add-btn', ['href' => route('admin.catalog.create'), 'item' => 'Catalog'])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bgc-white bd">
                {!! $catalogRender !!}
            </div>
        </div>
    </div>
@endsection
