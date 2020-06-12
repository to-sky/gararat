@extends('website.layouts.master')

@section('title', optional($page)->trans('title'))

@section('description')
    {{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}
@endsection

@section('content')
    <div class="homepage">
        {{-- Slider --}}
        <div id="homeSlider" class="carousel slide home-slider" data-ride="carousel" data-interval="7000">
            <div class="carousel-inner">
                @foreach($slides as $slide)
                    <div class="carousel-item
                                @if($loop->first) active @endif
                                @if($slide->trans('title') || $slide->trans('sub_title')) blackout @endif"
                         style="background-image: url({{ asset($slide->getFirstMediaUrl('home_slide'))  }})">

                        <div class="carousel-caption text-{{ $slide->displayTextPosition(true) }}">
                            @if($slide->trans('title'))
                                <h1 class="carousel-title text-uppercase">{{ $slide->trans('title') }}</h1>
                            @endif

                            @if($slide->trans('sub_title'))
                                <p class="carousel-sub-title">{{ $slide->trans('sub_title') }}</p>
                            @endif

                            @if ($slide->link)
                                <p class="carousel-read-more">
                                    <a href="{{ $slide->link }}" class="btn btn-danger border-0">{{ __('Read more') }}</a>
                                </p>
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
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="home-icons__item">
                        <a href="{{ route('equipment.index') }}" class="home-icons__link">
                            <i class="home-icons__icon equipment-icon"></i>
                            {{ __('Equipment') }}
                        </a>
                    </div>

                    <div class="home-icons__item">
                        <a href="{{ route('parts.index') }}" class="home-icons__link">
                            <i class="home-icons__icon parts-icon icon-size_s"></i>
                            {{ __('Parts') }}
                        </a>
                    </div>

                    @if($page->isPageExists('services'))
                        <div class="home-icons__item">
                            <a href="{{ url('services') }}" class="home-icons__link">
                                <i class="home-icons__icon services-icon icon-size_s"></i>
                                {{ __('Services') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @if(optional($page)->trans('title'))
        <section>
            <div class="container">
                <h1 class="text-center homepage-title">{{ $page->trans('title') }}</h1>
            </div>
        </section>
        @endif

        @if(optional($page)->trans('body'))
        <section class="bg-white">
            <div class="container">
                {!! $page->trans('body') !!}
            </div>
        </section>
        @endif

        <section class="news">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h2 class="page-title d-flex justify-content-between">{{ __('News') }}</h2>
                    <a href="{{ route('news.index') }}" class="btn btn-outline-danger align-self-baseline">{{ __('Other news') }}</a>
                </div>

                <div class="row">
                    @foreach($news as $item)
                        <div class="col-sm-6 col-lg-4">
                            @include('website.includes._news-item')
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="subscribe-section" id="subscribe">
            <div class="container">
                <div class="bg-white p-5 shadow-sm">
                    <h3 class="mb-card text-center text-muted font-weight-light">{{ __('Subscribe to our news') }}</h3>
                    <div class="row">
                        <form action="{{ route('subscribe') }}" method="post" class="col-md-6 offset-md-3">
                            @csrf

                            <div class="form-row align-items-center">
                                <div class="input-group">
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" placeholder="example@mail.com" required
                                           value="{{ old('email') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="submit">{{ __('Subscribe') }}</button>
                                    </div>
                                </div>

                                @error('email')
                                    <p class="d-block invalid-feedback mt-3">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
