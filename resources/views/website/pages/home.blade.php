@extends('website.layouts.master')

@section('title', __('Agricultural tractors, equipment, genuine spare parts and service'))

@section('description')
    {{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}
@endsection

@section('content')
    {{-- Slider --}}
    <div id="homeSlider" class="carousel slide home-slider" data-ride="carousel" data-interval="7000">
        <ol class="carousel-indicators">
            @foreach($slides as $key => $slide)
            <li data-target="#homeSlider" data-slide-to="{{ $key }}" @if($loop->first) class="active" @endif></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($slides as $slide)
            <div class="carousel-item @if($loop->first) active @endif blackout"
                 style="background-image: url({{ asset($slide->getFirstMediaUrl('home_slide'))  }})">

                <div class="carousel-caption container text-{{ $slide->displayTextPosition(true) }}">
                    <h1 class="carousel-title text-uppercase">{{ $slide->trans('title') }}</h1>
                    <p class="carousel-sub-title">{{ $slide->trans('sub_title') }}</p>
                    @if ($slide->link)
                        <p class="carousel-read-more"><a href="{{ $slide->link }}" class="btn btn-primary">{{ __('Read more') }}</a></p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Main content --}}
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
                                        <img src="{{ asset($item->getFirstMediaUrl('news_images', 'medium')) }}" alt="{{ $item->name }}" class="image">
                                        <div class="news-item__date">
                                            <h4>{{ $item->created_at->format('d') }}</h4>
                                            <h6>{{ $item->created_at->format('M') }}</h6>
                                        </div>
                                    </a>
                                </div>

                                <div class="news-item__body">
                                    <h3>
                                        <a href="{{ route('news.show', $item) }}">
                                            {{ $item->trans('name') }}
                                        </a>
                                    </h3>

                                    <p>{{ $item->trans('short_description') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
