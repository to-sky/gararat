<div class="input-group overflow-hidden">
    <div class="input-group-prepend">
        <span class="input-group-text">{{ $label ?? 'Upload' }}</span>
    </div>
    <div class="custom-file">
        <input type="file" class="custom-file-input"
               @isset ($id) id="{{ $id }}" @endisset
               name="{{ $name }}" @isset($multiple) multiple @endisset
               @isset($required) required @endisset
               @isset($formats) accept='{{ $formats }}' @endisset/>

        <label class="custom-file-label" @isset ($id) for="{{ $id }}" @endisset>
            {{ $placeholder ?? 'Choose file' }}
        </label>
    </div>
</div>
