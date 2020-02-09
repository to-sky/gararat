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
        <a href="{{ route('admin.order.index') }}" class="nav-link {{ request()->routeIs('admin.order.index') || request()->routeIs('admin.order.edit')? 'active' : '' }}">
            <span class="icon-holder">
                <i class="c-blue-500 ti-bar-chart"></i>
            </span>
            <span class="title">Orders</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('securedCatalogListPage') }}" class="nav-link {{ request()->routeIs('securedCatalogListPage') ? 'active' : '' }}">
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
        <a href="{{ route('securedPagesListPage') }}" class="nav-link">
            <span class="icon-holder"><i class="c-blue-500 ti-files"></i></span>
            <span class="title">Pages</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-files"></i></span>
            <span class="title">News</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('securedAddNewNewsItem') }}">Add</a></li>
            <li><a class="nav-link" href="{{ route('securedNewsListPage') }}">List</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-list"></i> </span>
            <span class="title">Slider</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('securedAddSlidePage') }}">Add</a></li>
            <li><a class="nav-link" href="{{ route('securedSlidesPage') }}">List</a></li>
        </ul>
    </li>
    <!--
    <li class="nav-item">
        <a href="" class="nav-link"><span class="icon-holder"><i class="c-blue-500 ti-user"></i> </span><span class="title">Users</span></a>
    </li>
    -->
    <li class="nav-item">
        <a href="{{ route('uploadCSVPage') }}" class="nav-link"><span class="icon-holder"><i class="c-blue-500 ti-save"></i> </span><span class="title">Import CSV</span></a>
    </li>
</ul>
