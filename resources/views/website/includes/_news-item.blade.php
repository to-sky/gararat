<div class="col-12 col-md-6 col-lg-3">
    <div class="shadow-sm section__news-item">
        <div class="news-item__image">
            <a href="{{ route('news.show', $item) }}">
                <img src="{{ asset($item->getFirstMediaUrl('news_images', 'medium')) }}"
                     alt="{{ $item->trans('name') }}" class="image">

                <div class="news-item__date">
                    <h4>{{ $item->created_at->format('d') }}</h4>
                    <h6>{{ $item->created_at->format('M') }}</h6>
                </div>
            </a>
        </div>

        <div class="news-item__body">
            <h3>
                <a href="{{ route('news.show', $item) }}">
                    {{ $item->trans('title') }}
                </a>
            </h3>

            <p>{{ $item->trans('short_description') }}</p>
        </div>
    </div>
</div>