<ul class="sidebar-menu scrollable pos-r ps">
    <li class="nav-item mT-30">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-home"></i>
            </span>
            <span class="title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.order.index') }}"
           class="nav-link {{
                request()->routeIs('admin.order.index') ||
                request()->routeIs('admin.order.edit')? 'active' : ''
            }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-bar-chart"></i>
            </span>
            <span class="title">Orders</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.catalog.index') }}"
           class="nav-link {{
                request()->routeIs('admin.catalog.index') ||
                request()->routeIs('admin.catalog.create') ||
                request()->routeIs('admin.catalog.edit') ? 'active' : ''
            }}">
            <span class="icon-holder"><i class="c-blue-500 ti-layout-list-thumb"></i></span>
            <span class="title">Catalog</span>
        </a>
    </li>

    {{-- Products --}}
    <li class="nav-item dropdown {{
                request()->routeIs('admin.products.index') ||
                request()->routeIs('admin.products.create') ||
                request()->routeIs('admin.products.edit') ? 'open' : ''
        }}">
        <a href="javascript:void(0);" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-package"></i></span>
            <span class="title">Products</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li class="nav-item">
                <a href="{{ route('admin.products.index', 0) }}"
                   class="nav-link {{
                       request()->is('secured/admin/products/sections/0') ||
                       request()->is('secured/admin/products/0/add') ||
                       request()->is('secured/admin/products/0/*/actions/edit') ? 'active' : ''
                   }}">
                    Equipment
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.products.index', 1) }}"
                   class="nav-link {{
                       request()->is('secured/admin/products/sections/1') ||
                       request()->is('secured/admin/products/1/add') ||
                       request()->is('secured/admin/products/1/*/actions/edit') ? 'active' : ''
                   }}">
                    Parts
                </a>
            </li>
        </ul>
    </li>

    {{-- Parts constructor --}}
    <li class="nav-item">
        <a href="{{ route('admin.figures.index') }}"
           class="nav-link {{
                request()->routeIs('admin.figures.index') ||
                request()->routeIs('admin.figures.create') ||
                request()->routeIs('admin.figures.constructor.create') ? 'active' : ''
            }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-pencil"></i>
            </span>
            <span class="title">Parts constructor</span>
        </a>
    </li>

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
                <i class="c-blue-500 ti-save"></i>
            </span>
            <span class="title">Import CSV</span>
        </a>
    </li>
</ul>
