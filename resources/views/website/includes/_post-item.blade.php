<div class="post">
    <div class="post__image-wrapper">
        <a href="{{ route('posts.show', $post) }}"
               style="background-image: url('{{ asset($post->getFirstMediaUrl("thumbnail")) }}');"
               class="post__image"></a>

        <div class="post__date">
            <h4 class="post__day">{{ $post->created_at->format('d') }}</h4>
            <h6 class="post__month">{{ $post->created_at->format('M') }}</h6>
        </div>
    </div>

    <div class="post__body" data-mh="post-body">
        <h3 class="post__title">
            <a href="{{ route('posts.show', $post) }}" class="post__title-link">{{ $post->trans('title') }}</a>
        </h3>

        <p class="post__short-description">{{ $post->trans('short_description') }}</p>
    </div>
</div>