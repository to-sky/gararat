@extends('website.layouts.master')

@section('title', __('Blog'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('blog') }}

        <h1 class="page-title">{{ __('Blog') }}</h1>

        <div class="custom-tabs">
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
@endsection