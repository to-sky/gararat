@extends('website.layouts.master')

@section('title', $equipment->trans('name'))
@section('og-title', $equipment->trans('name'))
@section('og-description', $equipment->trans('description'))
@section('og-image', asset($equipment->getFirstMediaUrl('main_image', 'large')))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('equipment', $equipment) }}

        <h1 class="page-title">
            {{ $equipment->trans('name') }}
            <span class="float-{{ isLocaleEn() ? 'right' : 'left' }}">
                @auth
                    <a href="{{ $equipment->path('edit') }}" class="btn btn-sm-icon btn-outline-muted" target="_blank">
                        <i class="fas fa-edit"></i>
                    </a>
                @endauth
            </span>
        </h1>

        <div class="row mb-5">
            <div class="col-md-6">
                @component('website.includes._product_images', ['product' => $equipment])
                @endcomponent
            </div>
            <div class="col-md-6">
                @component('website.includes._product_description', ['product' => $equipment, 'btnClass' => 'w-100'])
                @endcomponent
            </div>
        </div>

        <div class="custom-tabs-secondary shadow-sm mb-3">
            <div class="nav-tabs">
                <ul class="nav border-bottom" id="tabs" role="tablist">
                    @if($equipment->trans('body'))
                        <li class="nav-item">
                            <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">{{ __('Description') }}</a>
                        </li>
                    @endif

                    @if (! is_null($equipment->specifications))
                    <li class="nav-item">
                        <a class="nav-link @if(! $equipment->trans('body')) active @endif" id="specification-tab"
                           data-toggle="tab" href="#specification" role="tab" aria-controls="specification" aria-selected="false">
                            {{ __('Technical description')}}</a>
                    </li>
                    @endif
                </ul>

                <div class="tab-content mb-3" id="tabContent">
                    @if($equipment->trans('body'))
                        <div class="tab-pane fade show active p-3 bg-white" id="main" role="tabpanel" aria-labelledby="main-tab">
                            {!! $equipment->trans('body') !!}
                        </div>
                    @endif

                    @if (! is_null($specifications = $equipment->specifications))
                    <div class="tab-pane fade @if(! $equipment->trans('body')) show active @endif" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                        <div class="product__description">
                            <table class="table">
                                <tbody>
                                @foreach($specifications as $specification)
                                    <tr>
                                        <th>{{ $specification[translate('title')] ?? '' }}</th>
                                        <th>{{ $specification[translate('description')] ?? '' }}</th>
                                    </tr>

                                    @foreach($specification['data'] as $key => $data)
                                        <tr>
                                            <td>{{ $data[translate('key')] ?? '' }}</td>
                                            <td>{{ $data[translate('value')] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
@endsection
