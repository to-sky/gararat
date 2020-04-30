@extends('website.layouts.master')

@section('title', __('News'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('news') }}

        <h1 class="page-title">{{ __('News') }}</h1>

        <div class="section__news">
                <div class="row">
                    @foreach($news as $item)
                        @include('website.includes._news-item')
                        {{--<div class="col-12 col-md-6 col-lg-3">--}}
                            {{--<div class="shadow-sm section__news-item mb-5">--}}
                                {{--<div class="news-item__image">--}}
                                    {{--<a href="{{ route('news.show', $item) }}">--}}
                                        {{--<img src="{{ asset($item->getFirstMediaUrl('news_images', 'medium')) }}"--}}
                                             {{--alt="{{ $item->trans('name') }}" class="image">--}}

                                        {{--<div class="news-item__date">--}}
                                            {{--<h4>{{ $item->created_at->format('d') }}</h4>--}}
                                            {{--<h6>{{ $item->created_at->format('M') }}</h6>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</div>--}}

                                {{--<div class="news-item__body">--}}
                                    {{--<h3>--}}
                                        {{--<a href="{{ route('news.show', $item) }}">--}}
                                            {{--{{ $item->trans('title') }}--}}
                                        {{--</a>--}}
                                    {{--</h3>--}}

                                    {{--<p>{{ $item->trans('short_description') }}</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    @endforeach
                </div>
        </div>
    </div>
@endsection