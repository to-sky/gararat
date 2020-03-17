@extends('website.layouts.master')

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
        @if($catalogView === 1)
            <div class="row @if(!App::isLocale('en')) flex-row-reverse @endif">
                @include('website.catalog.includes.childs-renderer')
            </div>
        @else
            <div class="row @if($catalogView !== 1 && $catalogType == 0 && !App::isLocale('en')) flex-row-reverse @endif">
                @if($catalogType == 0)
                    @include('website.catalog.includes.equipment-renderer')
                @else
                    @include('website.catalog.includes.parts-renderer', ['hideFilters' => false])
                @endif
            </div>
        @endif
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
