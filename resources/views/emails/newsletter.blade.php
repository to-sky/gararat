@component('mail::message')

@if($thumbnail = $post->getFirstMedia('thumbnail'))
<p style="text-align: center">
    <img src="{{ asset($thumbnail->getUrl()) }}" alt="{{ $thumbnail->name }}" style="max-height: 100px; ">
</p>
@endif

<div class="text-center">
<h2 class="text-center">{{ $post->trans('title') }}</h2>

<p class="text-center">{{ $post->trans('short_description') }}</p>

@component('mail::button', ['url' => $post->link(), 'color' => 'success'])
    {{ __('Read more') }}
@endcomponent

<a href="{{ route('unsibscribe.destroy', $subscriber) }}" target="_blank" style="color: #999;font-size: 12px;">
    {{ __('Unsubscribe') }}
</a>
</div>

@endcomponent