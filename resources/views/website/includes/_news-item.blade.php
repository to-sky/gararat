<div class="col-sm-6 col-lg-4 col-xl-3">
    <div class="news-item">
        <div class="news__image-wrapper">
            <a href="{{ route('news.show', $item) }}"
               style="background-image: url('{{ asset($item->getFirstMediaUrl("thumbnail")) }}');"
               class="news__image"></a>

            <div class="news__date">
                <h4 class="news__day">{{ $item->created_at->format('d') }}</h4>
                <h6 class="news__month">{{ $item->created_at->format('M') }}</h6>
            </div>
        </div>

        <div class="news__body" data-mh="news-body">
            <h3 class="news__title">
                <a href="{{ route('news.show', $item) }}" class="news__title-link">{{ $item->trans('title') }}</a>
            </h3>

            <p class="news__short-description">{{ $item->trans('short_description') }}</p>
        </div>
    </div>
</div>