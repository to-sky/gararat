@extends('website.layouts.master')

@section('title', __('Catalog'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('catalog') }}

        <h1 class="page-title">{{ __('Catalog') }}</h1>

        <div class="row">
            @foreach($equipmentCategories as $equipmentCategory)
                <div class="col-md-3">
                    <div class="catalog-card shadow-sm" data-mh="catalog">
                        <div class="catalog-card__image-wrapper">
                            <a href="{{ route('catalog.category', $equipmentCategory) }}"
                               style="background-image: url('{{ asset($equipmentCategory->getFirstMediaUrl('image', 'medium')) }}');"
                               class="catalog-card__image"></a>
                        </div>

                        <div class="p-2">
                            <a href="{{ route('catalog.category', $equipmentCategory) }}">
                                <h5 class="catalog-card__title">{{ $equipmentCategory->trans('name') }}</h5>
                            </a>
                            @if($equipmentCategory->trans('description'))
                                <p class="catalog-card__description">{{ $equipmentCategory->trans('description') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
