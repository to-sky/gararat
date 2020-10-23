<div class="post">
    <div class="post__image-wrapper">

        <div class="modal fade" id="modalPostVideo{{ $post->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-body mb-0 p-0">
                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                            {!! $post->trans('body') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" data-toggle="modal" data-target="#modalPostVideo{{ $post->id }}">
            <img class="img-fluid" src="{{ asset($post->getFirstMediaUrl("thumbnail")) }}" alt="video">
            <i class="youtube-play-icon pos-a-center player-icon"></i>
        </a>

        <div class="post__date">
            <h4 class="post__day">{{ $post->created_at->format('d') }}</h4>
            <h6 class="post__month">{{ $post->created_at->format('M') }}</h6>
        </div>
    </div>

    <div class="post__body" data-mh="post-body">
        <h3 class="post__title">
            <a href="#" class="post__title-link" data-toggle="modal" data-target="#modalPostVideo{{ $post->id }}">
                {{ $post->trans('title') }}
            </a>
        </h3>
    </div>

</div>