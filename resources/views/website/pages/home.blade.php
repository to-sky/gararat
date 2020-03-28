@extends('website.layouts.master')

@section('title')
    {{ __('Agricultural tractors, equipment, genuine spare parts and service') }}
@endsection

@section('description')
    {{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}
@endsection

@section('content')
    <div class="slider__wrapper1 position-relative">
        <div class="slider-pro" id="homeSlider">
            <div class="sp-slides">
                @foreach($slides as $slide)
                    <div class="sp-slide">
                        @if($slide->sl_description !== null)
                            <a href="{{ $slide->sl_description }}">
                                <img src="{{ asset($slide->sl_image) }}" alt="{{ $slide->sl_title }}">
                            </a>
                        @else
                            <img src="{{ asset($slide->sl_image) }}" alt="{{ $slide->sl_title }}">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <h1 class="text-center homepage">{{ isLocaleEn() ? $home->block_1 : $home->block_1_ar }}</h1>
    </div>

    <div class="section bg-section">
        <div class="container">
            <div>
                <h2>{{ isLocaleEn() ? $home->block_2 : $home->block_2_ar }}</h2>
                <div>{!! isLocaleEn() ? $home->block_3 : $home->block_3_ar !!}</div>
            </div>

            <div class="section__blocks">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/2.jpg') }}" alt="Tractors">
                            <a href="{{ route('equipment.index') }}">
                                <span>{{ __('Equipment') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/4.jpg') }}" alt="Parts">
                            <a href="{{ route('parts.index') }}">
                                <span>{{ __('Parts') }}</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/3.jpg') }}" alt="Service">
                            <a href="{{ route('services') }}">
                                <span>{{ __('Services') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div>
                        <h2>{{ isLocaleEn() ? $home->block_4 : $home->block_4_ar }}</h2>
                        <div>{!! isLocaleEn() ? $home->block_5 : $home->block_5_ar !!}</div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <img src="{{ asset('assets/sections/1.jpg') }}" alt="Belarus agriculture tractors" class="image">
                </div>
            </div>

            <div class="section__icons">
                <div class="row">
                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg">
                        <img src="{{ asset('assets/sections/5.png') }}" alt="530+ Happy customer">
                        <p><strong>530+</strong></p>
                        <p>{{ __('Happy customer') }}</p>
                    </div>

                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg">
                        <img src="{{ asset('assets/sections/6.png') }}" alt="12+ Years of experience">
                        <p><strong>12+</strong></p>
                        <p>{{ __('Years of experience') }}</p>
                    </div>

                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg">
                        <img src="{{ asset('assets/sections/7.png') }}" alt="24 Month warranty">
                        <p><strong>24</strong></p>
                        <p>{{ __('Month warranty') }}</p>
                    </div>

                    <div class="text-center col-6 col-md-6 col-lg-3">
                        <img src="{{ asset('assets/sections/8.png') }}" alt="270+ Projects completed">
                        <p><strong>270+</strong></p>
                        <p>{{ __('Projects completed') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section bg-section">
        <div class="container">
            <h2>{{ __('Our News') }}</h2>
            <div class="section__news">
                <div class="row">
                    @foreach($news as $item)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="shadow-sm section__news-item">
                                <div class="news-item__image">
                                    <a href="{{ route('news.show', $item) }}">
                                        <img src="{{ asset($item->nw_image) }}" alt="{{ $item->nw_name }}" class="image">
                                        <div class="news-item__date">
                                            <h4>{{ $item->nw_created->format('d') }}</h4>
                                            <h6>{{ $item->nw_created->format('M') }}</h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="news-item__body">
                                    <h3>
                                        <a href="{{ route('news.show', $item) }}">
                                            {{ $item->trans('nw_name') }}
                                        </a>
                                    </h3>

                                    <p>{{ $item->trans('nw_description') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
