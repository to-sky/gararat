@extends('layouts.app')

@section('content')
    <h1 class="page-title">{{ $catalogName }}</h1>
    <p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dicta dolor, eos ex maxime nemo nesciunt odio optio praesentium, reiciendis rerum similique soluta voluptas voluptate, voluptatibus. Alias natus odio temporibus.</span><span>Adipisci alias, asperiores dignissimos esse fuga illum inventore nam nulla odio officia, saepe tempore voluptate voluptatibus. Adipisci aut dicta, earum error impedit iusto magnam non qui tempore ullam vitae voluptas.</span></p>
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
    <nav class="d-flex justify-content-center pagination__wrapper">
        {{ $products->links() }}
    </nav>
    <!-- /.d-flex justify-content-center pagination -->
@endsection
