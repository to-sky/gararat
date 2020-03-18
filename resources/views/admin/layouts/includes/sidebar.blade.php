<ul class="sidebar-menu scrollable pos-r ps">
    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-home"></i>
            </span>
            <span class="title">Dashboard</span>
        </a>
    </li>

    {{-- Orders --}}
    <li class="nav-item">
        <a href="{{ route('admin.order.index') }}"
           class="nav-link {{ request()->routeIs('admin.order.*')? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-bar-chart"></i>
            </span>
            <span class="title">Orders</span>
        </a>
    </li>

    {{-- Catalog --}}
    <li class="nav-item">
        <a href="{{ route('admin.catalog.index') }}"
           class="nav-link {{ request()->routeIs('admin.catalog.*') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 fas fa-stream"></i></span>
            <span class="title">Catalog</span>
        </a>
    </li>

    {{-- Manufacturers --}}
    <li class="nav-item">
        <a href="{{ route('admin.manufacturer.index') }}"
           class="nav-link {{ request()->routeIs('admin.manufacturer.*') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 fas fa-industry"></i></span>
            <span class="title">Manufacturers</span>
        </a>
    </li>

    {{-- Equipment with equipment groups--}}
    <li class="nav-item dropdown {{ request()->routeIs('admin.equipment.*') || request()->routeIs('admin.equipment-group.*') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 fas fa-tractor"></i></span>
            <span class="title">Equipment</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            {{-- Equipment --}}
            <li class="nav-item">
                <a href="{{ route('admin.equipment.index') }}"
                   class="nav-link {{ request()->routeIs('admin.equipment.*') ? 'active' : '' }}">
                    <span class="icon-holder"><i class="c-blue-500 fas fa-tractor"></i></span>
                    <span class="title ml-1">Equipment</span>
                </a>
            </li>

            {{-- Equipment groups --}}
            <li class="nav-item">
                <a href="{{ route('admin.equipment-group.index') }}"
                   class="nav-link {{ request()->routeIs('admin.equipment-group.*') ? 'active' : '' }}">
                    <span class="icon-holder"><i class="c-blue-500 fas fa-layer-group"></i></span>
                    <span class="title ml-1">Equipment groups</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- Parts --}}
    <li class="nav-item">
        <a href="{{ route('admin.part.index') }}"
           class="nav-link {{ request()->routeIs('admin.part.*') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 fas fa-cogs"></i></span>
            <span class="title">Parts</span>
        </a>
    </li>

    {{-- Units --}}
    <li class="nav-item">
        <a href="{{ route('admin.unit.index') }}"
           class="nav-link {{ request()->routeIs('admin.unit.*')  ? 'active' : ''}}">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-project-diagram"></i>
            </span>
            <span class="title">Units</span>
        </a>
    </li>

    {{-- Pages --}}
    <li class="nav-item">
        <a href="{{ route('admin.pages.index') }}"
           class="nav-link {{ request()->routeIs('admin.pages.*')  ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 ti-files"></i></span>
            <span class="title">Pages</span>
        </a>
    </li>

    {{-- News --}}
    <li class="nav-item">
        <a href="{{ route('admin.news.index') }}"
           class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-write"></i>
            </span>
            <span class="title">News</span>
        </a>
    </li>

    {{-- Slider --}}
    <li class="nav-item">
        <a href="{{ route('admin.slider.index') }}"
           class="nav-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-layout-slider"></i>
            </span>
            <span class="title">Slider</span>
        </a>
    </li>

    {{-- Importer --}}
    <li class="nav-item">
        <a href="{{ route('admin.importer.index') }}" class="nav-link">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-file-upload"></i>
            </span>
            <span class="title">Importer</span>
        </a>
    </li>
</ul>
