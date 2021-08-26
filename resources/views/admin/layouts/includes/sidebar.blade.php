<ul class="sidebar-menu scrollable pos-r ps">
    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-home"></i>
            </span>
            <span class="title">Dashboard</span>
        </a>
    </li>

    {{-- Orders --}}
    <li class="nav-item">
        <a href="{{ route('admin.orders.index') }}"
           class="nav-link {{ request()->routeIs('admin.orders.*')? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-chart-bar"></i>
            </span>
            <span class="title">Orders</span>
        </a>
    </li>

    {{-- Catalog --}}
    <li class="nav-item">
        <a href="{{ route('admin.catalogs.index') }}"
           class="nav-link {{ request()->routeIs('admin.catalogs.*') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 fas fa-stream"></i></span>
            <span class="title">Catalogs</span>
        </a>
    </li>

    {{-- Equipment with equipment groups--}}
    <li class="nav-item dropdown {{
            request()->routeIs('admin.equipment.*') ||
            request()->routeIs('admin.equipment-groups.*') ||
            request()->routeIs('admin.equipment-categories.*') ? 'open' : '' }}
        ">
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

            {{-- Equipment categoris --}}
            <li class="nav-item">
                <a href="{{ route('admin.equipment-categories.index') }}"
                   class="nav-link {{ request()->routeIs('admin.equipment-categories.*') ? 'active' : '' }}">
                    <span class="icon-holder"><i class="c-blue-500 fas fa-sitemap"></i></span>
                    <span class="title ml-1">Categories</span>
                </a>
            </li>

            {{-- Equipment groups --}}
            <li class="nav-item">
                <a href="{{ route('admin.equipment-groups.index') }}"
                   class="nav-link {{ request()->routeIs('admin.equipment-groups.*') ? 'active' : '' }}">
                    <span class="icon-holder"><i class="c-blue-500 fas fa-layer-group"></i></span>
                    <span class="title ml-1">Equipment groups</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- Parts --}}
    <li class="nav-item">
        <a href="{{ route('admin.parts.index') }}"
           class="nav-link {{ request()->routeIs('admin.parts.*') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 fas fa-cogs"></i></span>
            <span class="title">Parts</span>
        </a>
    </li>

    {{-- Units --}}
    <li class="nav-item">
        <a href="{{ route('admin.units.index') }}"
           class="nav-link {{ request()->routeIs('admin.units.*')  ? 'active' : ''}}">
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
            <span class="icon-holder"><i class="c-blue-500 far fa-copy"></i></span>
            <span class="title">Pages</span>
        </a>
    </li>

    {{-- Posts --}}
    <li class="nav-item">
        <a href="{{ route('admin.posts.index') }}"
           class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 far fa-newspaper"></i>
            </span>
            <span class="title">Posts</span>
        </a>
    </li>

    {{-- Slides --}}
    <li class="nav-item">
        <a href="{{ route('admin.slides.index') }}"
           class="nav-link {{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 far fa-images"></i>
            </span>
            <span class="title">Slides</span>
        </a>
    </li>

    {{-- Importer --}}
    <li class="nav-item">
        <a href="{{ route('admin.importer.index') }}"
           class="nav-link {{ request()->routeIs('admin.importer.index') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-file-upload"></i>
            </span>
            <span class="title">Importer</span>
        </a>
    </li>

    {{-- Offices --}}
    <li class="nav-item">
        <a href="{{ route('admin.offices.index') }}"
           class="nav-link {{ request()->routeIs('admin.offices.*') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-map-marker-alt"></i>
            </span>
            <span class="title">Offices</span>
        </a>
    </li>

    {{-- Settings --}}
    <li class="nav-item">
        <a href="{{ route('admin.settings') }}"
           class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-wrench"></i>
            </span>
            <span class="title">Settings</span>
        </a>
    </li>
</ul>
