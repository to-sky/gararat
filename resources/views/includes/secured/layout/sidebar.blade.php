<ul class="sidebar-menu scrollable pos-r ps">
    <li class="nav-item mT-30">
        <a href="{{ route('securedDashboardPage') }}" class="sidebar-link"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a href="" class="sidebar-link"><span class="icon-holder"><i class="c-blue-500 ti-bar-chart"></i> </span><span class="title">Orders</span></a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-layout-list-thumb"></i></span>
            <span class="title">Catalog</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="sidebar-link" href="">Add</a></li>
            <li><a class="sidebar-link" href="{{ route('securedCatalogListPage') }}">List</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-pencil"></i></span>
            <span class="title">Products</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="sidebar-link" href="">Add</a></li>
            <li><a class="sidebar-link" href="">List</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="icon-holder"><i class="c-blue-500 ti-files"></i></span>
            <span class="title">Pages</span>
            <span class="arrow"><i class="ti-angle-right"></i></span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="sidebar-link" href="">Add</a></li>
            <li><a class="sidebar-link" href="">List</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="" class="sidebar-link"><span class="icon-holder"><i class="c-blue-500 ti-user"></i> </span><span class="title">Users</span></a>
    </li>
</ul>