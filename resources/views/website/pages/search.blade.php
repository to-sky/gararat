@extends('website.layouts.master')

@section('title') {{ __('Search results for: :query', ['query' => request()->query('q')]) }} @endsection

@section('content')
    <div class="container">
        <h1 class="page-title">{{ __('Search results for: :query', ['query' => request()->query('q')]) }}</h1>
        <div class="products">
            <div class="row">
{{--                @include('website.catalog.includes.parts-renderer', ['hideFilters' => true])--}}
            </div>
        </div>

        <nav class="d-flex justify-content-center pagination__wrapper">
            {{--{{ $products->links() }}--}}
        </nav>
    </div>
@endsection
