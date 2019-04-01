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
        <h1 class="text-center homepage">Agricultural tractors, equipment, genuine spare parts and qualified service.</h1>
    </div>
    <!-- /.container -->
    <div class="section bg-section">
        <div class="container">
            <h2>GARARAT –the first e-hypermarket for agricultural tractors, equipment and spare parts!</h2>
            <p class="mb-0">GARARAT is a reliable equipment, genuine spare parts and qualified service for all branches of agriculture. We provide a full range of services: from consultations when choosing equipment to warranty and post-warranty maintenance.</p>
            <div class="section__blocks">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/2.jpg') }}" alt="Tractors">
                            <a href="{{ route('catalogPage', 1) }}"><span>Equipment</span></a>
                        </div>
                        <!-- /.section__block -->
                    </div>
                    <!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/4.jpg') }}" alt="Parts">
                            <a href="{{ route('catalogPage', 2) }}"><span>Parts</span></a>
                        </div>
                        <!-- /.section__block -->
                    </div>
                    <!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/3.jpg') }}" alt="Service">
                            <a href="#"><span>Service</span></a>
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
                    <h2>GARARAT Group of companies</h2>
                    <p>GARARAT – international group of companies specialised in agricultural tractors, equipment, spare parts and services.</p>
                    <p class="mb-0">More than 20 years we work in the field of agricultural equipment. Our Group consist of 9 sales and service points around Egypt and an Assembly plant in Alexandria.</p>
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
                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/5.png') }}" alt="530+ Happy customer"><p><strong>530+</strong></p><p>Happy customer</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/6.png') }}" alt="12+ Years of experience"><p><strong>12+</strong></p><p>Years of experience</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-6 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/7.png') }}" alt="24 Month warranty"><p><strong>24</strong></p><p>Month warranty</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-6 col-md-6 col-lg-3"><img src="{{ asset('assets/sections/8.png') }}" alt="270+ Projects completed"><p><strong>270+</strong></p><p>Projects completed</p></div>
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
            <h2>Our News</h2>
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
                                    <h3><a href="{{ route('singleNewsPage', $item->nw_id) }}">{{ $item->nw_name }}</a></h3>
                                    <p>{{ substr(strip_tags($item->nw_body), 0, 150) }}</p>
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
