@php
    $imageParams = [
        'width' => isset($fullWidth) ? '100%' : '150px',
        'size' => isset($fullWidth) ? '' : 'medium',
    ];
@endphp

@isset($mediaItem)
    <div class="border mt-4 mr-3 position-relative shadow-sm text-right text-white bgc-grey-100 @isset($class) {{ $class }} @endisset"
         data-image-container
         style="width: {{ $imageParams['width'] }}">
        <img src="{{ $mediaItem->getUrl() }}" class="card-img rounded-0" alt="{{ $mediaItem->name }}">

        <div class="card-img-overlay overflow-hidden p-0">
            <a href="{{ route('admin.media.destroy', $mediaItem) }}" class="bg-white border-bottom border-left py-1" data-image-action="delete">
                <i class="fa-trash-alt far p-5 text-danger"></i>
            </a>
        </div>
    </div>
@endif