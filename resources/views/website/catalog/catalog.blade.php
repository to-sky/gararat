@extends('layouts.app')

@section('content')
    @if(App::isLocale('en'))
        <h1 class="page-title">{{ $catalogName }}</h1>
        <div>
            {!! $page->pg_body !!}
        </div>
    @else
        <h1 class="page-title text-right">{{ $catalogName }}</h1>
        <div class="text-right">{!! $page->pg_body_ar !!}</div>
    @endif
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
    @if($catalogView == 0)
        <nav class="d-flex justify-content-center pagination__wrapper">
            {{ $products->links() }}
        </nav>
        <!-- /.d-flex justify-content-center pagination -->
    @endif
@endsection
