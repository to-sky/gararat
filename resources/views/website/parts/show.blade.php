@extends('website.layouts.master')

@section('title') {{ $part->trans('name') }} @endsection

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $part->trans('name') }}</h1>
        <div class="row">
            <div class="col-md-6">
                @component('website.components.product_images', ['product' => $part])
                @endcomponent
            </div>
            <div class="col-md-5 offset-1">
                @component('website.components.product_description', ['product' => $part])
                @endcomponent
            </div>
        </div>
    </div>
@endsection