@extends('website.layouts.master')

@section('title') {{ __('Contacts') }} @endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@section('content')
    <div class="container mb-5">
        {{ Breadcrumbs::render('contacts') }}

        <h1 class="page-title">{{ __('Contacts') }}</h1>

        <div class="row contacts">
            <div class="col-12 col-lg-6">
                <div class="contacts__info">
                    {!! $page->trans('pg_body') !!}
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="contacts__form">
                    <h3 class="mb-3">{{ __('Contact Us') }}</h3>

                    <form action="{{ route('contact-us') }}" method="post" autocomplete="off"
                          class="p-4 shadow-sm border border-light-sm contact-us" id="contactFormPageForm">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="name">{{ __('Name') }}*</label>
                                <input type="text" name="name" id="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-lg-6">
                                <label for="email">{{ __('Email') }}*</label>
                                <input type="email" name="email" id="email" required>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="phone">{{ __('Phone') }}*</label>
                                <input type="text" name="phone" id="phone" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="message">{{ __('Message') }}*</label>
                                <textarea name="message" id="message" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                @if(env('GOOGLE_RECAPTCHA_KEY'))
                                    <div class="g-recaptcha"
                                         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                    </div>

                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="pt-3">
                                            <strong>{{ __('Are you a robot?') }}</strong>
                                        </span>
                                    @endif
                                @endif
                            </div>

                            <div class="col-4">
                                <button class="btn btn-primary float-{{ isLocaleEn() ? 'right' : 'left' }}"
                                        type="submit">{{ __('Send') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid contacts">
        <div class="row">
            <div class="container">
                <h3>{{ __('Map') }}</h3>
            </div>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d863.6868215099953!2d31.411449829250078!3d30.015411998868327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDAwJzU1LjUiTiAzMcKwMjQnNDMuMiJF!5e0!3m2!1sru!2seg!4v1555091379312!5m2!1sru!2seg" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
@endsection
