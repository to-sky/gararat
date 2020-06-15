<label for="main_specifications">Main specifications</label>

@if($item && $item->main_specifications)
    @foreach($item->main_specifications['data'] as $key => $value)
        <div class="form-row form-group">
            {{--Key inputs --}}
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Key</span>
                    </div>
                    <input type="text" name="main_specifications[data][{{ $key }}][key]" class="form-control" value="{{ $value['key'] }}"
                           placeholder="English">
                    <input type="text" name="main_specifications[data][{{ $key }}][key_ar]" class="form-control"  value="{{ $value['key_ar'] }}"
                           placeholder="Arabic">
                </div>
            </div>

            {{--Value inputs --}}
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Value</span>
                    </div>
                    <input type="text" name="main_specifications[data][{{ $key }}][value]" class="form-control"  value="{{ $value['value'] }}"
                           placeholder="English">
                    <input type="text" name="main_specifications[data][{{ $key }}][value_ar]" class="form-control"  value="{{ $value['value_ar'] }}"
                           placeholder="Arabic">
                </div>
            </div>
        </div>
    @endforeach
@else
    @foreach(range(0, 2) as $key)
        <div class="form-row form-group">
            {{--Key inputs--}}
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Key</span>
                    </div>
                    <input type="text" name="main_specifications[data][{{ $key }}][key]" class="form-control"
                           placeholder="English">
                    <input type="text" name="main_specifications[data][{{ $key }}][key_ar]" class="form-control"
                           placeholder="Arabic">
                </div>
            </div>

            {{--Value inputs--}}
            <div class="col-md-6">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Value</span>
                    </div>
                    <input type="text" name="main_specifications[data][{{ $key }}][value]" class="form-control"
                           placeholder="English">
                    <input type="text" name="main_specifications[data][{{ $key }}][value_ar]" class="form-control"
                           placeholder="Arabic">
                </div>
            </div>
        </div>
    @endforeach
@endif


