@extends('website.layouts.master')

@section('title', __('Unsubscribe'))

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('unsubscribe') }}

        <div class="bg-white p-4 shadow-sm">
            <h5 class="mb-3 text-muted">{{ __('Unsubscribe') }}</h5>
            <p class="mb-4 text-muted">{{ __('Are you sure you want to unsubscribe from our newsletter?') }}</p>

            <form action="{{ route('unsibscribe.destroy', $subscriber) }}" method="post">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-outline-danger">{{ __('Unsubscribe') }}</button>
                <a href="{{ route('home') }}" class="btn btn-outline-muted text-uppercase">{{ __('No') }}</a>
            </form>
        </div>
    </div>
@endsection
