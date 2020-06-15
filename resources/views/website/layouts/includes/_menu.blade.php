<nav>
    @if($menu = SettingService::getMenu())
        @foreach($menu as $menuItem)
            @if($menuItem['is_dynamic'])
                <a href="{{ url($menuItem['slug']) }}" @if(request()->fullUrlIs('*/'. $menuItem['slug'])) class="active" @endif>
                    {{ translateArrayItem((array) $menuItem, 'name') }}
                </a>
            @else
                <a href="{{ route($menuItem['route']) }}" @if(request()->routeIs($menuItem['route_group'])) class="active" @endif>
                    {{ __($menuItem['name']) }}
                </a>
            @endif
        @endforeach
    @endif
</nav>