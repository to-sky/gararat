@php
    $body = json_decode($item->body);
    $body_ar = json_decode($item->body_ar);
@endphp

<div class="form-group">
    <div class="form-group">
        <div class="body__nav-container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="bodyTabTop" data-toggle="tab" href="#bodyTop" role="tab" aria-controls="bodyTop" aria-selected="true">Body top</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bodyArTopTab" data-toggle="tab" href="#bodyArTop" role="tab" aria-controls="bodyArTop" aria-selected="false">Body top arabic</a>
                </li>
            </ul>
            <div class="tab-content" id="bodyContentTop">
                <div class="tab-pane fade show active" id="bodyTop" role="tabpanel" aria-labelledby="bodyTabTop">
                <textarea name="body[top]" id="bodyTop" rows="8"
                          class="tinymce">{!! $body->top ?? '' !!}</textarea>
                </div>
                <div class="tab-pane fade" id="bodyArTop" role="tabpanel" aria-labelledby="bodyArTopTab">
                <textarea name="body_ar[top]" id="bodyArTop"
                          class="tinymce">{!! $body_ar->top ?? '' !!}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-group">
        <div class="body__nav-container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="bodyTabBottom" data-toggle="tab" href="#bodyBottom" role="tab" aria-controls="bodyBottom" aria-selected="true">Body bottom</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bodyArTabBottom" data-toggle="tab" href="#bodyArBottom" role="tab" aria-controls="bodyArBottom" aria-selected="false">Body bottom arabic</a>
                </li>
            </ul>
            <div class="tab-content" id="bodyContent1">
                <div class="tab-pane fade show active" id="bodyBottom" role="tabpanel" aria-labelledby="bodyTabBottom">
                <textarea name="body[bottom]" id="bodyBottom" rows="8"
                          class="tinymce">{!! $body->bottom ?? '' !!}</textarea>
                </div>
                <div class="tab-pane fade" id="bodyArBottom" role="tabpanel" aria-labelledby="bodyArTabBottom">
                <textarea name="body_ar[bottom]" id="bodyArBottom"
                          class="tinymce">{!! $body_ar->bottom ?? '' !!}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
