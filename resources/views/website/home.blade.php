@extends('layouts.app')

@section('content')
    <div class="slider__wrapper">
        <div class="container">
            <div class="slider-pro" id="my-slider">
                <div class="sp-slides">
                    @foreach($slides as $slide)
                        <div class="sp-slide">
                            <img src="{{ asset($slide->sl_image) }}" alt="{{ $slide->sl_title }}">
                        </div>
                        <!-- /.sp-slide -->
                    @endforeach
                </div>
                <!-- /.slider-pro -->
            </div>
            <!-- /.sp-slide -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.slider__wrapper -->
    <div class="container">
        @if(App::isLocale('en'))
            <h1 class="text-center homepage">
                {{ $home->block_1 }}
            </h1>
        @else
            <h1 class="text-center homepage text-right">
                {{ $home->block_1_ar }}
            </h1>
        @endif
    </div>
    <!-- /.container -->
    <div class="section bg-section">
        <div class="container">
            @if(App::isLocale('en'))
                <div>
                    <h2>{{ $home->block_2 }}</h2>
                    {!! $home->block_3 !!}
                </div>
            @else
                <div class="text-right">
                    <h2>{{ $home->block_2_ar }}</h2>
                    {!! $home->block_3_ar !!}
                </div>
            @endif
            <div class="section__blocks">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/2.jpg') }}" alt="Tractors">
                            <a href="{{ route('catalogPage', 1) }}">
                                @if(App::isLocale('en'))
                                    <span>Equipment</span>
                                @else
                                    <span>الرجعية</span>
                                @endif
                            </a>
                        </div>
                        <!-- /.section__block -->
                    </div>
                    <!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/4.jpg') }}" alt="Parts">
                            <a href="{{ route('catalogPage', 2) }}">
                                @if(App::isLocale('en'))
                                    <span>Parts</span>
                                @else
                                    <span>أجزاء</span>
                                @endif
                            </a>
                        </div>
                        <!-- /.section__block -->
                    </div>
                    <!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/3.jpg') }}" alt="Service">
                            <a href="{{ route('servicesPage') }}">
                                @if(App::isLocale('en'))
                                    <span>Service</span>
                                @else
                                    <span>الخدمات</span>
                                @endif
                            </a>
                        </div>
                        <!-- /.section__block -->
                    </div>
                    <!-- /.col-12 col-md-4 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.section__blocks -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section bg-section -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    @if(App::isLocale('en'))
                        <div>
                            <h2>{{ $home->block_4 }}</h2>
                            {!! $home->block_5 !!}
                        </div>
                    @else
                        <div class="text-right">
                            <h2>{{ $home->block_4_ar }}</h2>
                            {!! $home->block_5_ar !!}
                        </div>
                    @endif
                </div>
                <!-- /.col-12 col-lg-6 -->
                <div class="col-12 col-lg-5">
                    <img src="{{ asset('assets/sections/1.jpg') }}" alt="Belarus agriculture tractors" class="image">
                </div>
                <!-- /.col-12 col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="section__icons">
                <div class="row">
                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/5.png') }}" alt="530+ Happy customer"><p><strong>530+</strong></p><p>@if(App::isLocale('en')) Happy customer @elseعميل سعيد @endif</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/6.png') }}" alt="12+ Years of experience"><p><strong>12+</strong></p><p>@if(App::isLocale('en')) Years of experience @else سنوات من الخبرة @endif</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/7.png') }}" alt="24 Month warranty"><p><strong>24</strong></p><p>@if(App::isLocale('en')) Month warranty @else ضمان شهر @endif</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-6 col-md-6 col-lg-3"><img src="{{ asset('assets/sections/8.png') }}" alt="270+ Projects completed"><p><strong>270+</strong></p><p>@if(App::isLocale('en')) Projects completed @else المشاريع المنجزة @endif</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.section__icons -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section -->
    <div class="section bg-section">
        <div class="container">
            <h2>@if(App::isLocale('en')) Our News @else أخبارنا @endif</h2>
            <div class="section__news">
                <div class="row">
                    @foreach($news as $item)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="shadow-sm section__news-item">
                                <div class="news-item__image">
                                    <a href="{{ route('singleNewsPage', $item->nw_id) }}">
                                        <img src="{{ asset($item->nw_image) }}" alt="{{ $item->nw_name }}" class="image">
                                        <div class="news-item__date">
                                            <h4>{{ \Carbon\Carbon::parse($item->nw_created)->format('d') }}</h4>
                                            <h6>{{ \Carbon\Carbon::parse($item->nw_created)->format('M') }}</h6>
                                        </div>
                                        <!-- /.news-item__date -->
                                    </a>
                                </div>
                                <!-- /.news-item__image -->
                                <div class="news-item__body">
                                    @if(App::isLocale('en'))
                                        <h3><a href="{{ route('singleNewsPage', $item->nw_id) }}">{{ $item->nw_name }}</a></h3>
                                    @else
                                        <h3 class="text-right"><a href="{{ route('singleNewsPage', $item->nw_id) }}">{{ $item->nw_name_ar }}</a></h3>
                                    @endif
                                    @if(App::isLocale('en'))
                                        <p>{{ substr(strip_tags($item->nw_body), 0, 150) }}</p>
                                    @else
                                        <p class="text-right">{{ substr(strip_tags($item->nw_body_ar), 0, 150) }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- /.shadow-sm section__news-item -->
                        </div>
                        <!-- /.col-12 col-md-6 col-lg-3 -->
                    @endforeach
                </div>
                <!-- /.row -->
            </div>
            <!-- /.section__news -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section bg-section -->
@endsection
