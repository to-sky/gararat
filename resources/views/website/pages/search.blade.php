@extends('website.layouts.master')

@section('title', __('Search results for: :query', ['query' => request('q')]))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('search') }}

        <h4 class="page-title">{{ __('Search results for: :query', ['query' => request()->query('q')]) }}</h4>

        <div class="container">
            @forelse($products as $product)
            <div class="row search__item">
                <div class="col-4 col-sm-2 col-md-2 col-lg-1">
                    <img src="{{ $product->getFirstMediaUrl('main_image', 'thumb') }}" class="search__item__image">
                </div>

                <div class="col-8 col-sm-3 col-md-4 col-lg-5">
                    <a href="{{ $product->path() }}" class="search__item__link">
                        {{ $product->name }}
                    </a>

                    @if(is_a($product, 'App\Models\Part'))
                        <p class="search__item__producer-id ltr">{{ $product->producer_id }}</p>
                    @endif
                </div>

                <div class="col-5 col-sm-3 col-md-3">
                    <p class="search__item__price ltr">{!! $product->displayPrice() !!}</p>
                </div>

                <div class="col-4 col-sm-2 col-md-2">
                    @component('website.includes._product_qty_input', compact('product')) @endcomponent
                </div>

                <div class="col-3 col-sm-2 col-md-1 text-end">
                    @include('website.includes._btn_add_to_cart', ['product' => $product, 'icon' => true])
                </div>
            </div>

            @empty
                <div class="row">
                    @include('website.includes._search-empty-result')
                </div>
            @endforelse
        </div>

        <div class="pagination__wrapper mt-3">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
