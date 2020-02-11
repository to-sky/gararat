<ul class="sidebar-menu scrollable pos-r ps">
    <li class="nav-item mT-30">
        <a href="{{ route('securedDashboardPage') }}" class="nav-link {{ request()->routeIs('securedDashboardPage') ? 'active' : '' }}">
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
        <a href="{{ route('securedCatalogListPage') }}"
           class="nav-link {{
                request()->routeIs('securedCatalogListPage') ||
                request()->routeIs('securedAddCatalogItemPage') ||
                request()->routeIs('securedEditCatalogItemPage') ? 'active' : ''
            }}">
            <span class="icon-holder"><i class="c-blue-500 ti-layout-list-thumb"></i></span>
            <span class="title">Catalog</span>
        </a>
    </li>




    <li class="nav-item dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-package"></i></span>
            <span class="title">Products</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('productsListSecuredPage', 0) }}">Equipment</a></li>
            <li><a class="nav-link" href="{{ route('productsListSecuredPage', 1) }}">Parts</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-pencil"></i></span>
            <span class="title">Parts Constructor</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('initNewConstructorDrawingPage') }}">Add</a></li>
            <li><a class="nav-link" href="{{ route('listConstructorPage') }}">List</a></li>
        </ul>
    </li>

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

    <li class="nav-item">
        <a href="{{ route('uploadCSVPage') }}" class="nav-link">
            <span class="icon-holder">
                <i class="c-blue-500 ti-save"></i>
            </span>
            <span class="title">Import CSV</span>
        </a>
    </li>
</ul>
