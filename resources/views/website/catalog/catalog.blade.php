@extends('layouts.app')

@section('content')
    <h1 class="page-title">{{ $catalogName }}</h1>
    <p>
        @if($catalogType == 0)
            Reliable equipment for all agricultural demands.
        @else
            More than 10 000 genuine spare parts and consumables in our catalog with detailed drawings. You are able to choose and make order on-line.
        @endif
    </p>
    <div class="products">
        <div class="row">
            @if($catalogView === 1)
                @include('includes.website.catalog.childs-renderer')
            @else
                @if($catalogType == 0)
                    @include('includes.website.catalog.equipment-renderer')
                @else
                    @include('includes.website.catalog.parts-renderer', ['hideFilters' => false])
                @endif
            @endif
        </div>
        <!-- /.row -->
    </div>
    <!-- /.products -->
    @if($catalogType == 0)
        <nav class="d-flex justify-content-center pagination__wrapper">
            {{ $products->links() }}
        </nav>
        <!-- /.d-flex justify-content-center pagination -->
    @endif
@endsection
