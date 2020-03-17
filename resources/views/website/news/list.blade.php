@extends('website.layouts.master')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $pageTitle }}</h1>
        <div class="section">
            <div class="section__news">
                <div class="row">
                    @foreach($news as $item)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="shadow-sm section__news-item" style="margin-bottom: 30px;">
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
                                        @if($item->nw_description !== null)
                                            <p>{{ $item->nw_description }}</p>
                                        @else
                                            <p>{{ substr(strip_tags($item->nw_body), 0, 150) }}</p>
                                        @endif
                                    @else
                                        @if($item->nw_description_ar !== null)
                                            <p class="text-right">{{ $item->nw_description_ar }}</p>
                                        @else
                                            <p class="text-right">{{ substr(strip_tags($item->nw_body_ar), 0, 150) }}</p>
                                        @endif
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
    </div>
@endsection
