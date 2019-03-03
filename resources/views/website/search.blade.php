@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <div class="products">
            <div class="row">
                @include('includes.website.catalog.parts-renderer', ['hideFilters' => true])
            </div>
            <!-- /.row -->
        </div>
        <!-- /.products -->
        <nav class="d-flex justify-content-center pagination__wrapper">
            {{ $products->links() }}
        </nav>
        <!-- /.d-flex justify-content-center pagination -->
    </div>
    <!-- /.container -->
@endsection
