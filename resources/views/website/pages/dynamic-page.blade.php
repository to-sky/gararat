@extends('website.layouts.master')

@section('title', optional($page)->trans('name'))

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ optional($page)->trans('name') }}</li>
        </ol>

        <h1 class="page-title">{{ optional($page)->trans('title') }}</h1>

        <div>
            {!! optional($page)->trans('body') !!}

            @if (request()->is('financing'))
                {{-- TODO: form send with subject "Instalment request" --}}
                <div class="row">
                    <div class="container">
                        <div class="bg-white p-4 shadow-sm">
                            <h3 class="mb-card text-center text-muted font-weight-light">{{ __('Apply for funding') }}</h3>


                            <div class="row">
                                <form action="{{ route('subscribe') }}" method="post" class="col-md-6 offset-md-3">
                                    @csrf

                                    <div class="form-row align-items-center">
                                        <div class="input-group">
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" placeholder="example@mail.com" required
                                                   value="{{ old('email') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" type="submit">{{ __('Subscribe') }}</button>
                                            </div>
                                        </div>

                                        @error('email')
                                        <p class="d-block invalid-feedback mt-3">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection