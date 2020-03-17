<ul class="sidebar-menu scrollable pos-r ps">
    <li class="nav-item mT-30">
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

    {{-- Equipment groups --}}
    <li class="nav-item">
        <a href="{{ route('admin.equipment-group.index') }}"
           class="nav-link {{ request()->routeIs('admin.equipment-group.*') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 fas fa-layer-group"></i></span>
            <span class="title">Equipment groups</span>
        </a>
    </li>

    {{-- Equipment --}}
    <li class="nav-item">
        <a href="{{ route('admin.equipment.index') }}"
           class="nav-link {{ request()->routeIs('admin.equipment.*') ? 'active' : '' }}">
            <span class="icon-holder"><i class="c-blue-500 fas fa-tractor"></i></span>
            <span class="title">Equipment</span>
        </a>
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

    {{-- Parts constructor --}}
    {{--<li class="nav-item">--}}
        {{--<a href="{{ route('admin.figures.index') }}"--}}
           {{--class="nav-link {{--}}
                {{--request()->routeIs('admin.figures.index') ||--}}
                {{--request()->routeIs('admin.figures.create') ||--}}
                {{--request()->routeIs('admin.figures.constructor.create') ? 'active' : ''--}}
            {{--}}">--}}
            {{--<span class="icon-holder">--}}
                {{--<i class="c-blue-500 ti-pencil"></i>--}}
            {{--</span>--}}
            {{--<span class="title">Parts constructor</span>--}}
        {{--</a>--}}
    {{--</li>--}}

    {{-- Pages --}}
    <li class="nav-item">
        <a href="{{ route('admin.pages.index') }}"
           class="nav-link {{
                request()->routeIs('admin.pages.index') ||
                request()->routeIs('admin.pages.home') ||
                request()->routeIs('admin.pages.contacts') ||
                request()->routeIs('admin.pages.services') ||
                request()->routeIs('admin.pages.catalog') ? 'active' : ''
             }}">
            <span class="icon-holder"><i class="c-blue-500 ti-files"></i></span>
            <span class="title">Pages</span>
        </a>
    </li>

    {{-- News --}}
    <li class="nav-item">
        <a href="{{ route('admin.news.index') }}"
           class="nav-link {{
                request()->routeIs('admin.news.index') ||
                request()->routeIs('admin.news.create') ||
                request()->routeIs('admin.news.edit') ? 'active' : ''
            }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-write"></i>
            </span>
            <span class="title">News</span>
        </a>
    </li>

    {{-- Slider --}}
    <li class="nav-item">
        <a href="{{ route('admin.slider.index') }}"
           class="nav-link {{
                request()->routeIs('admin.slider.index') ||
                request()->routeIs('admin.slider.create') ||
                request()->routeIs('admin.slider.edit') ? 'active' : ''
            }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-layout-slider"></i>
            </span>
            <span class="title">Slider</span>
        </a>
    </li>

    {{-- Upload CSV --}}
    <li class="nav-item">
        <a href="{{ route('uploadCSVPage') }}" class="nav-link">
            <span class="icon-holder">
                <i class="c-blue-500 fas fa-file-upload"></i>
            </span>
            <span class="title">Import CSV</span>
        </a>
    </li>
</ul>
