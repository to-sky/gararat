@extends('website.layouts.master')

@section('title') {{ $equipment->trans('name') }} @endsection

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('equipment.show', $equipment) }}

        <h1 class="page-title">
            {{ $equipment->trans('name') }}
            <span class="float-{{ isLocaleEn() ? 'right' : 'left' }}">
                @auth
                    <a href="{{ route('admin.equipment.edit', $equipment) }}" class="btn btn-outline-muted" target="_blank">
                        <i class="fas fa-edit"></i>
                    </a>
                @endauth
            </span>
        </h1>

        <div class="row">
            <div class="col-md-6">
                @component('website.components.product_images', ['product' => $equipment])
                @endcomponent
            </div>
            <div class="col-md-5 offset-1">
                @component('website.components.product_description', ['product' => $equipment])
                @endcomponent
            </div>
        </div>

        @if (! is_null($specifications = $equipment->specifications))
            <div class="row">
                <div class="col-12">
                    <div class="product__description">
                        <h2>{{ __('Technical Description') }}</h2>

                        <table class="table shadow">
                            <tbody>
                            @foreach($specifications as $specification)
                                <tr>
                                    <th>{{ $specification[translate('title')] }}</th>
                                    <th>{{ $specification[translate('description')] }}</th>
                                </tr>

                                @foreach($specification['data'] as $key => $data)
                                    <tr>
                                        <td>{{ $data[translate('key')] }}</td>
                                        <td>{{ $data[translate('value')] }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection