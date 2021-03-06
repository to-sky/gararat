@extends('website.layouts.master')

@section('title', $part->trans('name'))
@section('og-title', $part->trans('name'))
@section('og-description', $part->producer_id)
@section('og-image', asset($part->getFirstMediaUrl('main_image', 'large')))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('parts.show', $part) }}

        <h1 class="page-title">{{ $part->trans('name') }}
            <span class="text-muted text-md align-middle ltr">({{ $part->producer_id }})</span>

            <span class="float-{{ isLocaleEn() ? 'right' : 'left' }}">
                @auth
                    <a href="{{ $part->path('edit') }}" class="btn btn-sm-icon btn-outline-muted" target="_blank">
                        <i class="fas fa-edit"></i>
                    </a>
                @endauth
            </span>
        </h1>


        <div class="row">
            <div class="col-md-6">
                @component('website.includes._product_images', ['product' => $part])
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('website.includes._product_description', ['product' => $part, 'btnClass' => 'w-100'])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
