<div class="form-group row">
    <div class="col">
        <p class="mb-1">Main image</p>
        @include('admin.includes._input-file', [
            'name' => 'main_image',
            'placeholder' => 'Select image',
            'formats' => '.jpg,.png,.tiff'
        ])
        @include('admin.includes._image_following_formats')

        @if (isset($item) && $mainImage = $item->getFirstMedia('main_image'))
            @include('admin.includes._form-image', [
                'mediaItem' => $mainImage
            ])
        @endif

    </div>
    <div class="col-md-8">
        <p class="mb-1">Additional images</p>
        @include('admin.includes._input-file', [
            'name' => 'additional_images[]',
            'multiple' => true,
            'placeholder' => 'Select images',
            'formats' => '.jpg,.png,.tiff'
        ])
        @include('admin.includes._image_following_formats')

        @error('additional_images')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="no-gutters row">
            @if(isset($item) && $images = $item->getMedia('additional_images'))
                @foreach($images as $image)
                    @include('admin.includes._form-image', ['mediaItem' => $image])
                @endforeach
            @endif
        </div>

    </div>
</div>