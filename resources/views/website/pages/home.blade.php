@extends('website.layouts.master')

@section('title', __('Agricultural tractors, equipment, genuine spare parts and service'))

@section('description')
    {{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}
@endsection

@section('content')
    <div class="homepage">
        {{-- Slider --}}
        <div id="homeSlider" class="carousel slide home-slider" data-ride="carousel" data-interval="97000">
            <div class="carousel-inner">
                @foreach($slides as $slide)
                    <div class="carousel-item
                                @if($loop->first) active @endif
                                @if($slide->trans('title') || $slide->trans('sub_title')) blackout @endif"
                         style="background-image: url({{ asset($slide->getFirstMediaUrl('home_slide'))  }})">

                        <div class="carousel-caption container text-{{ $slide->displayTextPosition(true) }}">
                            @if($slide->trans('title'))
                                <h1 class="carousel-title text-uppercase">{{ $slide->trans('title') }}</h1>
                            @endif

                            @if($slide->trans('sub_title'))
                                <p class="carousel-sub-title">{{ $slide->trans('sub_title') }}</p>
                            @endif

                            @if ($slide->link)
                                <p class="carousel-read-more"><a href="{{ $slide->link }}" class="btn btn-danger border-0">{{ __('Read more') }}</a></p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#homeSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">{{ __('Previous') }}</span>
            </a>
            <a class="carousel-control-next" href="#homeSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">{{ __('Next') }}</span>
            </a>
        </div>

        {{-- Main content --}}
        <section class="home-icons">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-center">
                    <div class="home-icons__item">
                        <a href="{{ route('equipment.index') }}" class="home-icons__link">
                            <i class="home-icons__icon equipment-icon"></i>
                            {{ __('Equipment') }}
                        </a>
                    </div>

                    <div class="home-icons__item">
                        <a href="{{ route('parts.index') }}" class="home-icons__link">
                            <i class="home-icons__icon parts-icon icon_size_s"></i>
                            {{ __('Parts') }}
                        </a>
                    </div>

                    <div class="home-icons__item">
                        <a href="{{ route('services') }}" class="home-icons__link">
                            <i class="home-icons__icon services-icon icon_size_s"></i>
                            {{ __('Services') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <h1 class="home-title">{{ isLocaleEn() ? $home->block_1 : $home->block_1_ar }}</h1>
            </div>
        </section>

        {{-- TODO: remove hardcode --}}
        <section class="bg-white">
            <div class="container">
                <h2 class="page-title">{{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}</h2>
                <p>{{ __('GARARAT is a reliable equipment, genuine spare parts and qualified service for all branches of agriculture. We provide a full range of services: from consultations when choosing equipment to warranty and post-warranty maintenance.') }}</p>
            </div>
        </section>

        <section>
            <div class="container">
                <h2 class="page-title">{{ __('Our News') }}</h2>
                <div class="section__news">
                    <div class="row">
                        @foreach($news as $item)
                            @include('website.includes._news-item')
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
