<div class="form-group">
    <div class="body__nav-container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="bodyTab" data-toggle="tab" href="#body" role="tab" aria-controls="body" aria-selected="true">Body</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="bodyArTab" data-toggle="tab" href="#bodyAr" role="tab" aria-controls="bodyAr" aria-selected="false">Body arabic</a>
            </li>
        </ul>
        <div class="tab-content" id="bodyContent">
            <div class="tab-pane fade show active" id="body" role="tabpanel" aria-labelledby="bodyTab">
                <textarea name="body" id="body" rows="8"
                          class="{{ $tinymceClass ?? 'tinymce' }} @error('body') is-invalid @enderror">{!! $item->body ?? old('body') !!}</textarea>

                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="tab-pane fade" id="bodyAr" role="tabpanel" aria-labelledby="bodyArTab">
                <textarea name="body_ar" id="bodyAr"
                          class="{{ $tinymceClass ?? 'tinymce' }}">{!! $item->body_ar ?? old('body_ar') !!}</textarea>
            </div>
        </div>
    </div>
</div>
