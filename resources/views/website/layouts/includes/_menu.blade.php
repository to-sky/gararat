<nav>
    <a href="{{ route('home') }}" @if(request()->routeIs('home')) class="active" @endif>{{ __('Home') }}</a>
    <a href="{{ route('equipment.index') }}" @if(request()->routeIs('equipment.*')) class="active" @endif>{{ __('Equipment') }}</a>
    <a href="{{ route('parts.index') }}" @if(request()->routeIs('parts.*')) class="active" @endif>{{ __('Parts') }}</a>
    <a href="{{ route('services') }}" @if(request()->routeIs('services')) class="active" @endif>{{ __('Services') }}</a>
    <a href="{{ route('news.index') }}" @if(request()->routeIs('news.*')) class="active" @endif>{{ __('News') }}</a>
    <a href="{{ route('contacts') }}" @if(request()->routeIs('contacts')) class="active" @endif>{{ __('Contacts') }}</a>
</nav>