@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}
                    @isset($breadcrumb->producer_id) <span class="ltr">({{ $breadcrumb->producer_id }})</span> @endisset
                </li>
            @endif

        @endforeach
    </ol>

@endif