@extends('layouts.app')

@section('content')
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
                            <a href="#"><span>Tractors</span></a>
                        </div>
                        <!-- /.section__block -->
                    </div>
                    <!-- /.col-12 col-md-4 -->
                    <div class="col-12 col-md-4">
                        <div class="section__block">
                            <img src="{{ asset('assets/sections/4.jpg') }}" alt="Parts">
                            <a href="#"><span>Parts</span></a>
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
                </div>
                <!-- /.col-12 col-lg-6 -->
                <div class="col-12 col-lg-5">
                    <img src="{{ asset('assets/sections/1.jpg') }}" alt="Belarus agriculture tractors" class="image">
                </div>
                <!-- /.col-12 col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section -->
@endsection
