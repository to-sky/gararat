<ul>
    <li @if(request()->routeIs('home')) class="active" @endif>
        <a href="{{ route('home') }}">{{ __('Home') }}</a>
    </li>
    <li @if(request()->routeIs('equipment.*')) class="active" @endif>
        <a href="{{ route('equipment.index') }}">{{ __('Equipment') }}</a>
    </li>
    <li @if(request()->routeIs('parts.*')) class="active" @endif>
        <a href="{{ route('parts.index') }}">{{ __('Parts') }}</a>
    </li>
    <li @if(request()->routeIs('services')) class="active" @endif>
        <a href="{{ route('services') }}">{{ __('Services') }}</a>
    </li>
    <li @if(request()->routeIs('news.*')) class="active" @endif>
        <a href="{{ route('news.index') }}">{{ __('News') }}</a>
    </li>
    <li @if(request()->routeIs('contacts')) class="active" @endif>
        <a href="{{ route('contacts') }}">{{ __('Contacts') }}</a>
    </li>
</ul>