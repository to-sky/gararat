@extends('website.layouts.master')

@section('title', optional($page)->trans('title'))

@section('description')
    {{ __('GARARAT – the first e-hypermarket for agricultural tractors, equipment and spare parts!') }}
@endsection

@section('content')
    <div class="homepage">
        {{-- Slider --}}
        <div class="container">
            <div id="homeSlider" class="row mx-sm-0 carousel slide home-slider" data-ride="carousel" data-interval="4000">
                <div class="carousel-inner">
                    @foreach($slides as $slide)
                        <div class="carousel-item
                            @if($loop->first) active @endif
                            @if($slide->blackout) blackout @endif"
                             @desktop
                                style="background-image: url({{ asset($slide->getFirstMediaUrl('home_slide'))  }})"
                             @elsedesktop
                                style="background-image: url({{ asset($slide->getFirstMediaUrl('home_slide_mobile'))  }})"
                             @enddesktop
                        >

                            @if($slide->trans('body'))
                                <div class="carousel-caption">
                                   {!! $slide->trans('body') !!}
                                </div>
                            @endif

                            @if ($slide->link)
                                <p class="carousel-read-more text-{{ $slide->displayBtnPosition(true) }}">
                                    <a href="{{ $slide->link }}" class="btn btn-responsive btn-danger border-0">{{ __('Read more') }}</a>
                                </p>
                            @endif
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
        </div>

        {{-- Main content --}}
        <section class="home-icons">
            <div class="container">
                <div class="col-xl-10 offset-xl-1">
                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="home-icons__item">
                            <a href="{{ route('equipment.index') }}" class="home-icons__link">
                                <i class="home-icons__icon equipment-icon"></i>
                                <span class="home-icons__label">{{ __('Equipment') }}</span>
                            </a>
                        </div>

                        <div class="home-icons__item">
                            <a href="{{ route('parts.index') }}" class="home-icons__link">
                                <i class="home-icons__icon parts-icon"></i>
                                <span class="home-icons__label">{{ __('Parts') }}</span>
                            </a>
                        </div>

                        <div class="home-icons__item">
                            <a href="{{ url('services') }}" class="home-icons__link">
                                <i class="home-icons__icon services-icon"></i>
                                <span class="home-icons__label">{{ __('Services') }}</span>
                            </a>
                        </div>

                        <div class="home-icons__item">
                            <a href="{{ url('financing') }}" class="home-icons__link">
                                <i class="home-icons__icon finance-icon"></i>
                                <span class="home-icons__label">{{ __('Financing') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(optional($page)->trans('body'))
        <div class="container">
            <div class="p-5 bg-white">
                {!! $page->trans('body') !!}
            </div>
        </div>
        @endif

        <section class="pb-0">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h2 class="page-title ">{{ __('Blog') }}</h2>
                </div>

                <div class="custom-tabs">
                    <div class="d-flex justify-content-between">
                        <ul class="nav" role="tablist">
                            @foreach($postTypes as $key => $postType)
                                @php
                                    $postTypeName = \App\Models\Post::getTypes()[$key];
                                @endphp

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($loop->first) active @endif" id="{{ $postTypeName }}-tab"
                                       data-toggle="tab" href="#{{ $postTypeName }}" role="tab" aria-controls="{{ $postTypeName }}"
                                       aria-selected="false">{{ trans($postTypeName) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-danger align-self-baseline">{{ __('All posts') }}</a>
                    </div>

                    <div class="mt-3">
                        <div class="tab-content">
                            @foreach($postTypes as $key => $postType)
                                @php
                                    $postTypeName = \App\Models\Post::getTypes()[$key];
                                @endphp

                                <div class="tab-pane fade show @if($loop->first) active @endif" id="{{ $postTypeName }}"
                                     role="tabpanel" aria-labelledby="{{ $postTypeName }}-tab">
                                    <div class="row">
                                        @foreach($postType as $post)
                                            <div class="col-sm-6 col-lg-4">
                                                @if ($post->type === \App\Models\Post::TYPE_VIDEO)
                                                    @include('website.includes._post-video')
                                                @else
                                                    @include('website.includes._post-item')
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
