@extends('website.layouts.master')

@section('title') {{ __('News') }} @endsection

@section('content')
    <div class="container">
        <h1 class="page-title">{{ __('News') }}</h1>
        <div class="section">
            <div class="section__news">
                <div class="row">
                    @foreach($news as $item)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="shadow-sm section__news-item mb-5">
                                <div class="news-item__image">
                                    <a href="{{ route('news.show', $item->nw_id) }}">
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