@extends('layouts.secured')

@section('content')
    <div class="row" id="figureConstructorWrapperTarget">
        <div class="col-12">
            <div class="bgc-white p-20 bd">
                <h6 class="c-grey-900">{{ $pageTitle }}</h6>
                <p class="m-0">Figure</p>
                <div class="bd mt-20 mb-20 figure" style="position: relative;">
                    <img src="{{ asset($figure->fig_image) }}" alt="{{ $pageTitle }}">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
