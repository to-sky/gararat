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
        <h1 class="text-center homepage">Tractors <span><span class="red">«Belarus»</span> in Egypt</span></h1>
    </div>
    <!-- /.container -->
    <div class="section bg-section">
        <div class="container">
            <h2>Production & Service</h2>
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad doloribus itaque natus necessitatibus pariatur quaerat reprehenderit tempore ullam. Aliquam at beatae cum cupiditate ipsam mollitia, pariatur quam quasi tempora veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aut cum error, harum hic natus nisi, nostrum perferendis perspiciatis quae quia sapiente sint sit totam unde vitae, voluptate? Eligendi, quam.</p>
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
                    <h2>Belarus agriculture tractors</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus eos eveniet ex exercitationem facilis itaque laudantium nemo quidem, reiciendis soluta totam unde vero vitae! Architecto autem distinctio itaque libero sint!</p>
                    <p class="mb-0"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dignissimos eaque exercitationem incidunt magnam obcaecati odit officiis porro temporibus veniam. A commodi impedit laborum obcaecati officiis perferendis perspiciatis, recusandae vero!</span><span>Architecto, dignissimos eius eos error facere fugit nemo nulla placeat porro provident, quia quod ullam voluptas! Corporis dicta error itaque minus, non numquam praesentium quasi totam. Et labore pariatur quibusdam.</span></p>
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
                    <div class="text-center col-12 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/5.png') }}" alt="530+ Happy customer"><p><strong>530+</strong></p><p>Happy customer</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-12 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/6.png') }}" alt="12+ Years of experience"><p><strong>12+</strong></p><p>Years of experience</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-12 col-md-6 col-lg-3 section__brg"><img src="{{ asset('assets/sections/7.png') }}" alt="24 Month warranty"><p><strong>24</strong></p><p>Month warranty</p></div>
                    <!-- /.text-center col-12 col-md-6 col-lg-3 section__brg -->
                    <div class="text-center col-12 col-md-6 col-lg-3"><img src="{{ asset('assets/sections/8.png') }}" alt="270+ Projects completed"><p><strong>270+</strong></p><p>Projects completed</p></div>
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
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="shadow-sm section__news-item">
                            <div class="news-item__image">
                                <a href="#">
                                    <img src="{{ asset('assets/sections/2.jpg') }}" alt="News Alt" class="image">
                                    <div class="news-item__date">
                                        <h4>12</h4>
                                        <h6>Nov</h6>
                                    </div>
                                    <!-- /.news-item__date -->
                                </a>
                            </div>
                            <!-- /.news-item__image -->
                            <div class="news-item__body">
                                <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta dignissimos, dolorem facere fuga fugiat illo ipsum magni molestias odit omnis perferendis placeat quaerat ratione recusandae repellendus sequi vel voluptas voluptate?</p>
                            </div>
                        </div>
                        <!-- /.shadow-sm section__news-item -->
                    </div>
                    <!-- /.col-12 col-md-6 col-lg-3 -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="shadow-sm section__news-item">
                            <div class="news-item__image">
                                <a href="#">
                                    <img src="{{ asset('assets/sections/2.jpg') }}" alt="News Alt" class="image">
                                    <div class="news-item__date">
                                        <h4>12</h4>
                                        <h6>Nov</h6>
                                    </div>
                                    <!-- /.news-item__date -->
                                </a>
                            </div>
                            <!-- /.news-item__image -->
                            <div class="news-item__body">
                                <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta dignissimos, dolorem facere fuga fugiat illo ipsum magni molestias odit omnis perferendis placeat quaerat ratione recusandae repellendus sequi vel voluptas voluptate?</p>
                            </div>
                        </div>
                        <!-- /.shadow-sm section__news-item -->
                    </div>
                    <!-- /.col-12 col-md-6 col-lg-3 -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="shadow-sm section__news-item">
                            <div class="news-item__image">
                                <a href="#">
                                    <img src="{{ asset('assets/sections/2.jpg') }}" alt="News Alt" class="image">
                                    <div class="news-item__date">
                                        <h4>12</h4>
                                        <h6>Nov</h6>
                                    </div>
                                    <!-- /.news-item__date -->
                                </a>
                            </div>
                            <!-- /.news-item__image -->
                            <div class="news-item__body">
                                <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta dignissimos, dolorem facere fuga fugiat illo ipsum magni molestias odit omnis perferendis placeat quaerat ratione recusandae repellendus sequi vel voluptas voluptate?</p>
                            </div>
                        </div>
                        <!-- /.shadow-sm section__news-item -->
                    </div>
                    <!-- /.col-12 col-md-6 col-lg-3 -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="shadow-sm section__news-item">
                            <div class="news-item__image">
                                <a href="#">
                                    <img src="{{ asset('assets/sections/2.jpg') }}" alt="News Alt" class="image">
                                    <div class="news-item__date">
                                        <h4>12</h4>
                                        <h6>Nov</h6>
                                    </div>
                                    <!-- /.news-item__date -->
                                </a>
                            </div>
                            <!-- /.news-item__image -->
                            <div class="news-item__body">
                                <h3><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta dignissimos, dolorem facere fuga fugiat illo ipsum magni molestias odit omnis perferendis placeat quaerat ratione recusandae repellendus sequi vel voluptas voluptate?</p>
                            </div>
                        </div>
                        <!-- /.shadow-sm section__news-item -->
                    </div>
                    <!-- /.col-12 col-md-6 col-lg-3 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.section__news -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section bg-section -->
@endsection
