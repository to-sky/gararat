<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFile">{{ $label ?? 'Upload' }}</span>
    </div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="{{ $id ?? 'imageField' }}" name="{{ $name }}" aria-describedby="inputGroupFile" {{ isset($required) ? 'required' : '' }}>
        <label class="custom-file-label" for="{{ $id ?? 'imageField' }}">{{ $placeholder ?? 'Choose file' }}</label>
    </div>
</div>